# Usa a imagem base PHP + Vapor (PHP 8.2)
FROM laravelphp/vapor:php82

WORKDIR /var/task

# 1) Copia manifestos e código de uma vez
COPY composer.json composer.lock package.json package-lock.json ./
COPY . .

# 2) Instala Composer e dependências PHP sem scripts
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 3) Gera autoload otimizado e descobre pacotes
RUN composer dump-autoload --optimize && \
    php artisan package:discover --ansi

# 4) Instala Node.js, NPM e dependências JS
RUN apk add --no-cache nodejs npm && \
    npm ci

# 5) Exponha as portas do Laravel (8000) e do Vite (5173)  
EXPOSE 8000 5173 

# 6) Ambiente de desenvolvimento
ENV APP_ENV=development
ENV APP_DEBUG=true

# 7) Comando que inicia Vite com HMR e o servidor Laravel simultaneamente
CMD ["sh", "-c", "npm run dev -- --host=0.0.0.0 & php artisan serve --host=0.0.0.0 --port=8000"]
