FROM laravelphp/vapor:php82

WORKDIR /var/task

# copia todos os arquivos do projeto pro container
COPY . .

<<<<<<< HEAD
# instala o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# instala as dependências do php
RUN composer install --no-dev --optimize-autoloader

# instala node.js (e o npm)
# esse comando tem que ser assim por conta do alpine
RUN apk add --no-cache nodejs npm

=======
# instala as dependências do php
RUN composer install --no-dev --optimize-autoloader

>>>>>>> 958145c24734b933cfb0aa36d9f1ba6e64377b93
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
