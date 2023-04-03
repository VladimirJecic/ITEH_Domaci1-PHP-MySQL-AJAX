1.domaci iz predmeta Internet tehnologije

Uradjen je sa idejom internet prodavnice izmisljenog biznisa prodaje parfema po imenu Heliotrope(ime cveta sa lepim mirisom).
Sajt nije osmiljen uz internet marketing plan vec je pre svega moj projekat na kojem sam vezbao upotrebu bootstrapa,javascripta,css-a i php-a.

Serverside je radjen u mikro-frejmvorku po imenu Flight kako bi se lakže obezbedile neke osnovne funkcionalnosti,dok će drugi domaći imati za fokus baš rad sa frejmvorkom REACT. Ovaj domaći za temu ima savladavanje osnovnih GET,POST,PUT,DELETE zahteva ostvarenih kombinacijom ajaxa(Asynchronous JavaScript And XML) i PHP-a po principima arhitekture REST-a(Asynchronous JavaScript And XML).

Konkretno funkcionalnosti koje će moj sajt staviti na raspolaganje korisniku su:
-Učitavanje i filtriranje postojećih parfema po brendu,delu imena,polu itd. i sortiranje po imenu,ceni asc i desc (ostvareno sa SQL-om korišćenjem WHERE i ORDER)
-Učitavanje slike novog parfema i čuvanje te slike i podataka o parfemu ime/brend/pol/tester u bazi kao jednu transakciju (commit/rollback opcije)
-Selektovanje i izmena polja parfema u posebnom prozoru/modalu
-Brisanje Parfema
-Dodavanje filtiranih proizvoda u korpu
-Uvid u broj proizvoda i ukupan račun kroz cart-dropdown dugme,bez obaveze da se napusti trenutna stranicaa sa proizvodima
-Uvid u korpu na posebnoj stranici gde ce kao i u prethodnoj stavci biti učitani svi proizvodi php-em koristeći globalne varijable sesije kako bi stanje korpe bilo uvek zapamćeno bez obzira na kojoj stranici sajta se korisnik/kupac bude nalazio. Mogućnost menjanja broja odredjenog proizvoda,izbacivanja pojedinih proizvoda ili pražnjenja cele korpe i laka navaigacija nazad u prodavnicu
