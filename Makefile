# Вхід у контейнер PHP CLI# Вхід у контейнер PHP CLI
cli c:
	docker exec -it lead-status-php-cli bash
# Запустити контейнери
up u:
	docker compose up -d
# Вийти і видалити контейнери
down d:
	docker compose down
# Перебудувати контейнери
build b:
	docker compose up --build -d
# Видалити volumes
volumes v:
	docker compose down -v

