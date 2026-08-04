# PCN Boxe - Contact Email Cloudflare Worker

This Cloudflare Worker receives contact form submissions from the PCN Boxe website and sends formatted HTML & plain-text emails via [Resend](https://resend.com) to `pcnboxe06@gmail.com` (from `contact@pcnboxe.com`).

---

## 🚀 How to Deploy to Cloudflare

Run the following commands from inside the `workers/contact-worker` directory:

```bash
# Navigate to worker folder
cd workers/contact-worker

# 1. (Optional) Log out of current account if logged in under another account (e.g. ludetc)
npx wrangler logout

# 2. Log into your pcnboxe Cloudflare account
npx wrangler login

# 3. Deploy the worker
npm run deploy
```

Once deployed, Wrangler will display your live worker URL (e.g. `https://pcnboxe-contact-worker.<your-subdomain>.workers.dev`).

---

## 📡 API Specification (POST Request)

### Endpoint URL

Depending on how you configure Cloudflare, you can use either option:

1. **Custom Domain Route (Recommended)**: `https://pugilistclubnicois.fr/api/contact`
2. **Workers.dev Subdomain (Deployed & Active)**: `https://pcnboxe-contact-worker.pcnboxe06.workers.dev`

### HTTP Method
`POST`

### Headers
`Content-Type: application/json`

---

## 📋 Request Parameters

| Parameter | Type | Required | Description | Example |
| :--- | :--- | :---: | :--- | :--- |
| `name` | `string` | **Yes** | Full name of the visitor | `"Jean Dupont"` |
| `email` | `string` | **Yes** | Email address of the visitor | `"jean.dupont@example.com"` |
| `phone` | `string` | No | Phone number | `"06 12 34 56 78"` |
| `course` | `string` | No | Desired course or discipline | `"Boxing · Adults"` |
| `message` | `string` | **Yes** | Visitor's message content | `"Je souhaite m'inscrire au cours adultes."` |

---

## 📩 Example Request Payload

```json
{
  "name": "Jean Dupont",
  "email": "jean.dupont@example.com",
  "phone": "06 12 34 56 78",
  "course": "Boxing · Adults",
  "message": "Bonjour, je souhaite m'inscrire pour les séances de boxe adultes. Quelles sont les démarches ?"
}
```

---

## 📤 Response Formats

### Success Response (`HTTP 200 OK`)

```json
{
  "success": true,
  "message": "Email envoyé avec succès",
  "id": "resend_email_id_12345"
}
```

### Validation Error (`HTTP 400 Bad Request`)

```json
{
  "error": "Tous les champs obligatoires (Nom, Email, Message) doivent être remplis."
}
```

### Resend API / Server Error (`HTTP 500` or `HTTP 4xx`)

```json
{
  "error": "Erreur lors de l'envoi du message via Resend.",
  "details": { ... }
}
```

---

## 💻 Frontend JavaScript Integration Example

```javascript
const WORKER_URL = 'https://pcnboxe-contact-worker.<your-subdomain>.workers.dev';

async function sendContactForm(formData) {
  try {
    const response = await fetch(WORKER_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        name: formData.name,       // Required
        email: formData.email,     // Required
        phone: formData.phone,     // Optional
        course: formData.course,   // Optional
        message: formData.message  // Required
      }),
    });

    const result = await response.json();

    if (response.ok && result.success) {
      alert("Merci ! Votre message a bien été envoyé.");
    } else {
      alert("Erreur: " + (result.error || "Impossible d'envoyer le message."));
    }
  } catch (error) {
    console.error("Submission failed:", error);
    alert("Une erreur réseau est survenue.");
  }
}
```

---

## 🔑 Environment Variables

The worker relies on `RESEND_API_KEY`, which is set via Cloudflare secret or `.dev.vars`:
- `RESEND_API_KEY`: `<YOUR_RESEND_API_KEY>`

Alternatively, you can manage the secret via Wrangler CLI:

```bash
npx wrangler secret put RESEND_API_KEY
```
