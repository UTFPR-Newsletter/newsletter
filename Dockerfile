FROM laravelphp/vapor:php82

WORKDIR /var/task

# copia todos os arquivos do projeto pro container
COPY . .

# instala as dependências do php
RUN composer install --no-dev --optimize-autoloader

# instala as dependências do node.js (Vue e Inertia)
RUN if [ -f package.json ]; then \
        npm install && \
        npm run build; \
    fi

# permissão
RUN chown -R www-data:www-data /var/task/storage /var/task/bootstrap/cache

# porta padrão do laravel
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
