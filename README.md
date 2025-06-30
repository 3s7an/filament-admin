README
1. Naklonovanie projektu
git clone https://github.com/3s7an/filament-admin.git

2. Presun sa do zložky projektu
cd filament-admin

3. Inštalácia závislostí 
composer install
npm install

4. Vytvorenie .env suboru z .env.example
cp .env.example .env

5. Vytvorenie klúča appky
php artisan key:generate

6. Vytvorenie migrácie pre knižnicu Spatie, ktorá je nevyhnutná na priradenie obrazkov k modelom
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"

7. Vytvorenie uživatela / prihlasovacich udajov 
php artisan make:filament-user

8. Vytvorenie migrácií (vrátane DB)
php artisan migrate

9. Vytvorenie sim linku pre storage 
php artisan storage:link

10. Komplikacia front endu
npm run dev

11. Spustenie lokalneho serveru
php artisan serve

12. + /admin na koniec linku pre prihlasenie do appky
http://127.0.0.1:8000/admin

Bonusové funkcie : 
- Hromadná aktivácia, deaktivácia a odstránenie kategórií a produktov -> treba zakliknut checkboxy v tabulke
- Koláčový graf pre zobrazenie aktívnych a neaktívnych kategorií a produktov
