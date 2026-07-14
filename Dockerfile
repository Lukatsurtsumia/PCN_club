# PCN — Pugilist Club Niçois — production image (Laravel 12, nginx + php-fpm)
# Same reliable pattern as the BoxerOS deploy. No database needed (file-based storage).

# ---- Stage 1: compile front-end assets (Vite + Tailwind) ----
FROM node:22-alpine AS assets
WORKDIR /build
COPY . .
RUN npm install && npm run build

# ---- Stage 2: application runtime (nginx + php-fpm, serves /app/public on :80) ----
FROM webdevops/php-nginx:8.3-alpine

ENV WEB_DOCUMENT_ROOT=/app/public \
    COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

# Application source
COPY --chown=application:application . /app

# Compiled assets from stage 1 (overwrites the source public/build)
COPY --from=assets --chown=application:application /build/public/build /app/public/build

# PHP dependencies (production only) + writable Laravel dirs
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist \
 && ln -sf /app/storage/app/public /app/public/storage \
 && chown -R application:application /app/storage /app/bootstrap/cache
