Чтобы получить MAKE для windows:
```
winget install GnuWin32.Make
```
Добавь эту папку в PATH:

Пуск → "Изменение переменных среды" → Path → Добавить путь 
C:\Program Files (x86)\GnuWin32\bin

---
Первый запуск:

```
make init
```

Сайт: http://localhost:8005

PhpMyAdmin: http://localhost:8080

Не забудьте редактировать данные в .env с secret на более сложные пароли


После каждого обновление через git pull origin main
------------

```
make sync
```
