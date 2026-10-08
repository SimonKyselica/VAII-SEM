# PlaytestHub

Šimon Kyselica

5ZYI31

## Stručný opis projektu

Nezávislí herní vývojári potrebujú spätnú väzbu od ľudí mimo tímu ešte pred vydaním hry. Testovanie dnes zvyčajne prebieha roztrúsene cez Discord, formuláre a e-maily, kde sa hlásenia strácajú, opakujú a nie je jasné, ku ktorej verzii hry patria. Hráči, ktorí by radi skúšali nové hry pred vydaním, zase nemajú miesto, kde ich nájsť.

PlaytestHub je webová platforma, ktorá tieto dve skupiny spája. Vývojár zverejní projekt so screenshotmi a testovacie buildy s popisom zmien a odkazom na stiahnutie. Testeri si v katalógu nájdu hry podľa žánru a platformy a prihlásia sa na testovanie. Ku každému buildu vyplnia dotazník, ktorý vývojár pripravil, a chyby hlásia cez štruktúrovaný formulár so screenshotmi a tagmi. Vývojár tak vidí, ako sa hodnotenie hry mení medzi verziami, a všetky hlásenia triedi podľa stavu a priority na jednom mieste.

## Role v projekte

Aplikácia rozlišuje tri roly prihlásených používateľov a neprihláseného návštevníka. Rola je uložená ako atribút používateľa a oprávnenia sa kontrolujú na strane servera pri každej akcii.

- **Návštevník (neprihlásený)** – prezerá katalóg verejných projektov a ich detail. Nemôže sa prihlásiť na testovanie ani posielať hlásenia. Môže sa zaregistrovať.
- **Tester** – registrovaný používateľ, ktorý testuje hry. Prihlasuje sa na testovanie projektov, vypĺňa dotazníky k buildom a vytvára štruktúrované hlásenia so screenshotmi a tagmi. Upravovať a mazať môže len vlastné hlásenia, a to iba kým majú stav Nové. Zodpovedá za kvalitu a pravdivosť svojich hlásení a odpovedí.
- **Vývojár** – má všetky oprávnenia testera a navyše vytvára a spravuje vlastné projekty, ich screenshoty, buildy, tagy a dotazníky. Vo vlastných projektoch vidí všetky hlásenia a odpovede na dotazníky, mení stav a prioritu hlásení a pozýva testerov. V cudzích projektoch má len oprávnenia testera. Zodpovedá za obsah svojich projektov a za spracovanie spätnej väzby.
- **Administrátor** – spravuje používateľov (zmena roly, zablokovanie účtu) a číselník žánrov. Moderuje obsah: môže skryť alebo odstrániť nevhodný projekt, hlásenie či komentár. Do triedenia hlásení vo vývojárových projektoch nezasahuje.

## Prípady použitia podľa rolí

### Návštevník

- Návštevník si prezerá katalóg verejných projektov.
- Návštevník filtruje katalóg podľa žánru a platformy a vyhľadáva podľa názvu.
- Návštevník si zobrazí detail projektu s popisom, obálkou, galériou screenshotov a zoznamom buildov.
- Návštevník sa zaregistruje a zvolí si typ účtu (tester alebo vývojár).

### Tester

- Tester sa prihlási do aplikácie a odhlási sa z nej.
- Tester sa prihlási na testovanie verejného projektu alebo z neho odstúpi.
- Tester prijme alebo odmietne pozvánku do súkromného projektu.
- Tester si stiahne build cez odkaz uvedený pri builde.
- Tester vyplní dotazník k buildu, a to najviac raz za build.
- Tester vytvorí hlásenie k buildu cez štruktúrovaný formulár (názov, typ, závažnosť, popis, kroky na zopakovanie, tagy, screenshoty).
- Tester upraví alebo zmaže vlastné hlásenie, kým ho vývojár nezačal riešiť.
- Tester potvrdí existujúce hlásenie („+1“), ak narazil na rovnaký problém.
- Tester komentuje hlásenia v projekte, ktorý testuje.
- Tester si zobrazí prehľad svojich hlásení a vyplnených dotazníkov naprieč projektmi.

### Vývojár

Vývojár môže v cudzích projektoch robiť všetko, čo tester. Navyše:

- Vývojár vytvorí projekt (názov, popis, žánre, obálka, viditeľnosť), upraví ho alebo zmaže.
- Vývojár nahrá screenshoty projektu, zmení ich poradie alebo ich zmaže.
- Vývojár definuje tagy svojho projektu (napr. Grafika, Zvuk, Ovládanie).
- Vývojár pridá build (verzia, platforma, changelog, odkaz na stiahnutie, dotazník), upraví ho alebo zmaže.
- Vývojár zostaví dotazník z otázok typu krátka odpoveď, dlhá odpoveď a škála 1–5 a priradí ho jednému alebo viacerým buildom.
- Vývojár si zobrazí odpovede na dotazník rozdelené podľa buildu: priemery škálových otázok a zoznam textových odpovedí.
- Vývojár pozve testera do súkromného projektu alebo ho z projektu odoberie.
- Vývojár si zobrazí hlásenia k projektu a filtruje ich podľa buildu, stavu, typu, závažnosti a tagov.
- Vývojár zmení stav a prioritu hlásenia priamo v zozname.
- Vývojár odpovedá na hlásenia v komentároch.
- Vývojár si zobrazí štatistiky projektu (počet hlásení podľa stavu a buildu, počet testerov).

### Administrátor

- Administrátor si zobrazí zoznam používateľov, zmení ich rolu alebo zablokuje účet.
- Administrátor pridá, upraví alebo zmaže žáner.
- Administrátor skryje alebo odstráni nevhodný projekt, hlásenie alebo komentár.

## Plánované entity

Do minima troch entít sa rátajú Projekt, Screenshot, Build, Dotazník, Otázka, Vyplnenie, Hlásenie, Príloha, Tag, Komentár a Žáner. Používateľ a asociačné tabuľky sa nerátajú. Všetky CRUD operácie budú implementované nad entitami Projekt, Build, Dotazník a Hlásenie.

| Entita | Účel | Najdôležitejšie atribúty | Vzťahy |
| --- | --- | --- | --- |
| Používateľ | Účet v systéme | meno, e-mail, hash hesla, rola (tester, vývojár, administrátor), zablokovaný, dátum registrácie | vlastní projekty, testuje projekty, je autorom hlásení, komentárov a vyplnení |
| Projekt | Hra zverejnená na testovanie | vlastník, názov, popis, obálka (súbor), viditeľnosť (verejný, súkromný), stav testovania (otvorené, uzavreté), dátum vytvorenia | patrí vývojárovi, má screenshoty, buildy, dotazníky, tagy, žánre a testerov |
| Screenshot | Obrázok z hry v galérii projektu | projekt, cesta k súboru, popis, poradie, dátum nahratia | patrí projektu |
| Build | Konkrétna testovacia verzia hry | projekt, dotazník (voliteľný), verzia (napr. 0.4.1), platforma (Windows, macOS, Linux, Web, Android), changelog, odkaz na stiahnutie, dátum vydania | patrí projektu, používa dotazník, má vyplnenia a hlásenia |
| Dotazník | Sada otázok, ktoré vývojár kladie testerom | projekt, názov, popis, dátum vytvorenia | patrí projektu, má otázky, je priradený k buildom |
| Otázka | Jedna otázka dotazníka | dotazník, text, typ (krátka odpoveď, dlhá odpoveď, škála 1–5), povinná, poradie | patrí dotazníku |
| Vyplnenie | Jedno odoslanie dotazníka testerom ku konkrétnemu buildu | build, tester, dátum odoslania | patrí buildu a testerovi, má odpovede |
| Hlásenie | Chyba alebo spätná väzba ku konkrétnemu buildu | build, autor, názov, typ (chyba, pád, návrh, iné), závažnosť (určuje tester), priorita (určuje vývojár), stav (Nové, Potvrdené, Rieši sa, Opravené, Zamietnuté), popis, kroky na zopakovanie, dátum vytvorenia a zmeny | patrí buildu a autorovi, má prílohy, tagy, komentáre a potvrdenia |
| Príloha | Screenshot priložený k hláseniu | hlásenie, cesta k súboru, pôvodný názov, MIME typ, veľkosť, dátum nahratia | patrí hláseniu |
| Tag | Štítok na triedenie hlásení v projekte | projekt, názov, farba | patrí projektu, priradený k hláseniam |
| Komentár | Diskusia k hláseniu | hlásenie, autor, text, dátum | patrí hláseniu a autorovi |
| Žáner | Číselník na kategorizáciu a filtrovanie projektov | názov | priradený k projektom |

Asociačné tabuľky (do počtu entít sa nerátajú):

- **Účasť na testovaní** – projekt, používateľ, stav (pozvaný, aktívny), dátum. Určuje, kto smie v projekte vypĺňať dotazníky a vytvárať hlásenia.
- **Odpoveď** – vyplnenie, otázka, hodnota (text alebo číslo 1–5). Spája vyplnenie s otázkami dotazníka.
- **Hlásenie – Tag** – hlásenie, tag.
- **Projekt – Žáner** – projekt, žáner.
- **Potvrdenie hlásenia** – hlásenie, používateľ, dátum. Dvojica je unikátna, takže jeden používateľ potvrdí hlásenie najviac raz.

Tester vyplní dotazník k jednému buildu najviac raz. Dotazník, ktorý už má vyplnenia, sa nedá upravovať ani zmazať, aby odpovede z rôznych buildov zostali porovnateľné.

## Vzťahy medzi entitami

Jadrom modelu je build: hlásenia aj vyplnené dotazníky sa viažu na konkrétnu verziu hry, takže sa spätná väzba dá porovnávať medzi buildmi.

&#91;embedded content: dátový model · 11 entít bez používateľa\]

- **Používateľ – Projekt (1:N):** vývojár vlastní projekty, projekt má jedného vlastníka.
- **Projekt – Screenshot, Build, Dotazník, Tag (1:N):** všetko, čo vývojár k hre pripraví, patrí jednému projektu.
- **Dotazník – Build (1:N):** jeden dotazník možno použiť pre viac buildov, build má najviac jeden dotazník.
- **Dotazník – Otázka (1:N):** dotazník sa skladá z otázok v určenom poradí.
- **Build – Vyplnenie a Build – Hlásenie (1:N):** spätná väzba je vždy viazaná na konkrétnu verziu.
- **Hlásenie – Príloha a Hlásenie – Komentár (1:N):** hlásenie má screenshoty a diskusiu.
- **Používateľ – Vyplnenie, Hlásenie, Komentár (1:N):** každý z nich má autora.
- **Vyplnenie – Otázka (M:N cez Odpoveď):** vyplnenie obsahuje odpoveď na každú otázku dotazníka.
- **Hlásenie – Tag (M:N):** hlásenie môže mať viac tagov a tag patrí viacerým hláseniam.
- **Projekt – Žáner (M:N):** projekt môže mať viac žánrov a žáner patrí viacerým projektom.
- **Používateľ – Projekt (M:N, účasť na testovaní):** tester testuje viac projektov a projekt má viac testerov.
- **Používateľ – Hlásenie (M:N, potvrdenie):** to isté hlásenie môže potvrdiť viac používateľov.

Používateľ je v diagrame pre prehľadnosť vynechaný. Zmazanie projektu kaskádovo odstráni jeho screenshoty, buildy, dotazníky, vyplnenia, hlásenia, komentáre a prílohy vrátane súborov na disku.

## Hlavné stránky aplikácie

Aplikácia bude mať 14 stránok, z toho 13 s dynamickým obsahom.

| Stránka | Prístup | Účel |
| --- | --- | --- |
| Katalóg projektov | všetci | Úvodná stránka s kartami hier, filtrom podľa žánru a platformy a vyhľadávaním bez znovunačítania stránky (AJAX). |
| Detail projektu | všetci (súkromný len pozvaní) | Popis, žánre, galéria screenshotov, zoznam buildov s changelogmi a odkazmi, tlačidlo na prihlásenie na testovanie. |
| Formulár projektu | vývojár | Vytvorenie a úprava projektu, nahratie obálky a screenshotov, výber žánrov a viditeľnosti, správa tagov. |
| Správa buildov | vývojár (vlastník) | Zoznam buildov projektu, pridanie, úprava a mazanie buildu, priradenie dotazníka. |
| Editor dotazníka | vývojár (vlastník) | Pridávanie, úprava, mazanie a zoradenie otázok bez znovunačítania stránky (AJAX). |
| Vyplnenie dotazníka | tester projektu | Formulár vygenerovaný z otázok dotazníka priradeného k buildu. |
| Odpovede na dotazník | vývojár (vlastník) | Priemery škálových otázok a textové odpovede, filtrované podľa buildu. |
| Hlásenia projektu | vývojár (vlastník), testeri projektu | Tabuľka hlásení s filtrami podľa buildu, stavu, typu, závažnosti a tagov. Vývojár mení stav a prioritu priamo v tabuľke (AJAX). |
| Detail hlásenia | vývojár (vlastník), testeri projektu | Popis, kroky na zopakovanie, tagy, galéria príloh, komentáre a tlačidlo „+1“. |
| Formulár hlásenia | tester projektu | Štruktúrovaný formulár: názov, typ, závažnosť, popis, kroky na zopakovanie, tagy a screenshoty. |
| Môj prehľad | prihlásený | Tester vidí svoje projekty, hlásenia so stavom a buildy, ktoré čakajú na vyplnenie dotazníka. Vývojár vidí svoje projekty s počtom nových hlásení a vyplnení. |
| Správa testerov | vývojár (vlastník) | Pozvánky do súkromného projektu a zoznam aktívnych testerov. |
| Administrácia | administrátor | Správa používateľov, žánrov a moderovanie obsahu. |
| Prihlásenie a registrácia | návštevník | Prihlasovací a registračný formulár. |

## Rozdelenie funkcionality

### Základné funkcie

- Registrácia, prihlásenie a odhlásenie, heslá uložené ako hash.
- Roly tester, vývojár a administrátor s kontrolou oprávnení na strane servera.
- CRUD projektov vrátane nahratia obálky, galérie screenshotov, tagov a výberu žánrov.
- CRUD buildov.
- CRUD dotazníkov s otázkami typu krátka odpoveď, dlhá odpoveď a škála 1–5 a ich priradenie k buildom.
- Vyplnenie dotazníka testerom a prehľad odpovedí pre vývojára (priemery škál, textové odpovede).
- CRUD štruktúrovaných hlásení vrátane tagov a nahrávania screenshotov.
- Prihlásenie na testovanie verejného projektu.
- Katalóg s filtrovaním podľa žánru a platformy (AJAX).
- Zmena stavu a priority hlásenia priamo v tabuľke (AJAX).
- Správa používateľov a žánrov administrátorom.
- Validácia vstupov na strane klienta aj servera, ochrana proti SQL injection a XSS.
- Responzívny dizajn.
- Docker prostredie, ktoré pri prvom spustení naimportuje ukážkové dáta.

### Rozširujúce funkcie

- Komentáre k hláseniam.
- Editor dotazníka s pridávaním a zoradením otázok bez znovunačítania stránky (AJAX).
- Otázky s výberom z možností.
- Kopírovanie dotazníka do novej verzie.
- Graf vývoja priemerných hodnotení naprieč buildmi.
- Súkromné projekty a pozvánky testerov.
- Potvrdenie hlásenia „+1“ (AJAX).
- Vloženie screenshotu zo schránky (Clipboard API) a nahrávanie pretiahnutím súboru (Drag and Drop API).
- Automatické uloženie rozpísaného hlásenia v prehliadači (Web Storage API).
- Upozornenie vývojára na nové hlásenie cez Discord webhook (externé API).
- Štatistiky hlásení s grafmi.
- Moderovanie obsahu administrátorom.
- Stránkovanie zoznamov (AJAX).
- Štýly v Sass a vlastné riešenie responzívneho layoutu.
