export default {
  async fetch(request, env, ctx) {
    // CORS headers to allow cross-origin requests from the PCN website
    const corsHeaders = {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'POST, OPTIONS',
      'Access-Control-Allow-Headers': 'Content-Type',
    };

    // Handle CORS preflight request
    if (request.method === 'OPTIONS') {
      return new Response(null, {
        status: 204,
        headers: corsHeaders,
      });
    }

    if (request.method !== 'POST') {
      return new Response(JSON.stringify({ error: 'Method not allowed' }), {
        status: 405,
        headers: { ...corsHeaders, 'Content-Type': 'application/json' },
      });
    }

    try {
      let body;
      const contentType = request.headers.get('content-type') || '';

      if (contentType.includes('application/json')) {
        body = await request.json();
      } else if (contentType.includes('multipart/form-data') || contentType.includes('application/x-www-form-urlencoded')) {
        const formData = await request.formData();
        body = Object.fromEntries(formData.entries());
      } else {
        body = await request.json();
      }

      const { name, email, phone, course, message } = body || {};

      // Validate required fields
      if (!name || !email || !message) {
        return new Response(
          JSON.stringify({
            error: 'Tous les champs obligatoires (Nom, Email, Message) doivent être remplis.',
          }),
          {
            status: 400,
            headers: { ...corsHeaders, 'Content-Type': 'application/json' },
          }
        );
      }

      const apiKey = env.RESEND_API_KEY;

      const emailSubject = `[PCN Boxe] Message de ${name}`;

      const safeName = escapeHtml(name);
      const safeEmail = escapeHtml(email);
      const safePhone = escapeHtml(phone || 'Non renseigné');
      const safeCourse = escapeHtml(course || 'Non spécifiée');
      const safeMessage = escapeHtml(message);

      const htmlContent = `
        <!DOCTYPE html>
        <html lang="fr">
        <head>
          <meta charset="utf-8">
          <style>
            body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; padding: 20px; }
            .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
            .header { background-color: #0b1329; color: #ffffff; padding: 24px; text-align: center; border-bottom: 3px solid #2563eb; }
            .header h1 { margin: 0; font-size: 20px; letter-spacing: 1px; font-weight: 700; text-transform: uppercase; }
            .header p { margin: 4px 0 0; font-size: 13px; color: #93c5fd; }
            .content { padding: 24px; }
            .field-row { display: flex; border-bottom: 1px solid #f1f5f9; padding: 12px 0; }
            .field-label { width: 140px; font-weight: 700; font-size: 13px; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px; }
            .field-value { flex: 1; font-size: 15px; color: #0f172a; font-weight: 500; }
            .message-box { margin-top: 20px; background-color: #f8fafc; border-left: 4px solid #2563eb; border-radius: 6px; padding: 16px; }
            .message-title { font-weight: 700; font-size: 12px; text-transform: uppercase; color: #2563eb; margin-bottom: 8px; letter-spacing: 0.5px; }
            .message-text { font-size: 14px; color: #334155; white-space: pre-wrap; margin: 0; }
            .footer { background: #f1f5f9; padding: 14px 24px; font-size: 12px; color: #64748b; text-align: center; }
          </style>
        </head>
        <body>
          <div class="card">
            <div class="header">
              <h1>Pugilist Club Niçois</h1>
              <p>Nouvelle demande de contact depuis le site web</p>
            </div>
            <div class="content">
              <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
                <tr>
                  <td width="140" style="font-weight: bold; color: #64748b; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid #f1f5f9;">Nom & Prénom</td>
                  <td style="font-size: 15px; color: #0f172a; border-bottom: 1px solid #f1f5f9;">${safeName}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold; color: #64748b; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid #f1f5f9;">Email</td>
                  <td style="font-size: 15px; color: #0f172a; border-bottom: 1px solid #f1f5f9;"><a href="mailto:${safeEmail}" style="color: #2563eb; text-decoration: none;">${safeEmail}</a></td>
                </tr>
                <tr>
                  <td style="font-weight: bold; color: #64748b; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid #f1f5f9;">Téléphone</td>
                  <td style="font-size: 15px; color: #0f172a; border-bottom: 1px solid #f1f5f9;">${safePhone}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold; color: #64748b; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid #f1f5f9;">Discipline</td>
                  <td style="font-size: 15px; color: #0f172a; border-bottom: 1px solid #f1f5f9;"><strong>${safeCourse}</strong></td>
                </tr>
              </table>

              <div class="message-box">
                <div class="message-title">Message du visiteur</div>
                <div class="message-text">${safeMessage}</div>
              </div>
            </div>
            <div class="footer">
              Ce message a été envoyé via le formulaire de contact du site <strong>PCN Boxe</strong>. Vous pouvez répondre directement à cet email pour contacter l'expéditeur.
            </div>
          </div>
        </body>
        </html>
      `;

      const textContent = `
Nouveau message de contact - Pugilist Club Niçois
--------------------------------------------------
Nom & Prénom : ${name}
Email        : ${email}
Téléphone    : ${phone || 'Non renseigné'}
Discipline   : ${course || 'Non spécifiée'}

Message :
${message}
      `.trim();

      const resendPayload = {
        from: 'contact@pcnboxe.com',
        to: ['pcnboxe06@gmail.com'],
        reply_to: email,
        subject: emailSubject,
        html: htmlContent,
        text: textContent,
      };

      const resendResponse = await fetch('https://api.resend.com/emails', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${apiKey}`,
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(resendPayload),
      });

      const resendResult = await resendResponse.json();

      if (!resendResponse.ok) {
        console.error('Resend API error:', resendResult);
        return new Response(
          JSON.stringify({
            error: resendResult.message || 'Erreur lors de l\'envoi du message via Resend.',
            details: resendResult,
          }),
          {
            status: resendResponse.status,
            headers: { ...corsHeaders, 'Content-Type': 'application/json' },
          }
        );
      }

      return new Response(
        JSON.stringify({
          success: true,
          message: 'Email envoyé avec succès',
          id: resendResult.id,
        }),
        {
          status: 200,
          headers: { ...corsHeaders, 'Content-Type': 'application/json' },
        }
      );
    } catch (err) {
      console.error('Worker error:', err);
      return new Response(
        JSON.stringify({ error: err.message || 'Erreur interne du serveur' }),
        {
          status: 500,
          headers: { ...corsHeaders, 'Content-Type': 'application/json' },
        }
      );
    }
  },
};

function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}
