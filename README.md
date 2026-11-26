# Fechtclub Kassel – WordPress-Theme

Theme für [fechtclub-kassel.de](https://www.fechtclub-kassel.de/) (Fechtclub Kassel e.V.).

**Hybrid-Theme:** Seitenstruktur über klassische PHP-Templates, Design-Tokens (Farben, Schriften, Abstände) über `theme.json`, Inhalte über den Block-Editor. Es ist **kein Block-/FSE-Theme**: Header, Footer und Templates lassen sich nicht im Website-Editor bearbeiten, sondern nur im Code bzw. über den Customizer.

- Benötigt WordPress ≥ 6.7 und PHP ≥ 7.4
- Keine Build-Tools: kein npm und kein Composer. Die Dateien im Repo sind das fertige Theme.
- Keine Abhängigkeit von Plugins

---

## Installation & Updates

Updates kommen über das Plugin [Git Updater](https://git-updater.com/). Den Bezug zum Repo stellt der Header in `style.css` her:

```
GitHub Theme URI: https://github.com/anoderay/fck-wp-theme
Primary Branch: main
```

1. Git Updater installieren und aktivieren. 
2. Theme über **Einstellungen → Git Updater → Install Theme** mit `anoderay/fck-wp-theme` installieren. 
3. Theme aktivieren.

### Neue Version veröffentlichen

1. `Version:` in `style.css` hochzählen (z. B. `1.1.0` → `1.2.0`)
2. Committen und nach `main` pushen
3. Release/Tag mit **genau dieser** Versionsnummer anlegen:
   ```sh
   git tag 1.2.0 && git push origin 1.2.0
   # oder: gh release create 1.2.0 --generate-notes
   ```

WordPress bietet das Update an, sobald die Version im Repo höher ist als die installierte. Git Updater cacht dabei für einige Stunden. Sofort geht es mit **Einstellungen → Git Updater → Refresh Cache**.

Sobald es Tags gibt, richtet sich Git Updater nach dem neuesten Tag und nicht mehr nach `main`. Ab dann muss jede Version getaggt werden.

### Ersteinrichtung nach der Aktivierung

1. **Einstellungen → Lesen:** „Eine statische Seite“ wählen, Startseite und Beitragsseite festlegen
2. **Design → Menüs:** Menüs den Positionen *Hauptnavigation* und *Footer-Navigation* zuweisen. Ohne zugewiesenes Hauptmenü listet der Header automatisch alle Seiten auf.
3. **Beiträge → Kategorien:** Kategorie mit dem Slug `ankuendigung` anlegen (siehe Block „Ankündigungen“)
4. **Customizer:** Logo, Header-Button, News-Seite und Copyright-Zeile setzen
5. Die News-Seite und andere Seiten aus vollbreiten Abschnitten auf das Template **„Volle Breite (Abschnitte)“** stellen
6. Seiten anlegen, auf die Header und Patterns fest verlinken: `/probetraining` und `/mitglied-werden` (siehe Hinweise unten)

---

## Was das Theme mitbringt

### Eigene Blöcke (Kategorie „Fechtclub Kassel“)

Beide Blöcke sind **dynamisch**: Die Ausgabe erzeugt `render.php` auf dem Server. Änderungen am Markup wirken deshalb sofort auf allen Seiten, ohne dass Inhalte neu gespeichert werden müssen.

| Block | Name | Zweck | Einstellungen |
|---|---|---|---|
| **Aktuelle News** | `fechtclub/news` | Neueste Beiträge als Karten, im selben Look wie die Blog-Übersicht (nutzt `template-parts/content-teaser.php`) | Überschrift, Anzahl, Kategorie, Seitennummerierung, „Mehr News“-Button (Text + URL) |
| **Ankündigungen** | `fechtclub/ankuendigung` | Band mit klickbaren Einzeilern (Titel + gekürzter Auszug) | Kategorie, Anzahl (0 = alle), max. Wörter |

**Ankündigungen:** Der Block zeigt veröffentlichte Beiträge der Kategorie mit dem Slug `ankuendigung`. Gibt es keine, verschwindet das Band vollständig. Ein- und ausgeschaltet wird es also, indem man einen Beitrag veröffentlicht oder auf Entwurf zurückstellt. Diese Kategorie wird aus dem News-Block (bei „Alle Kategorien“), der Blog-Übersicht, der Suche und dem Feed **ausgeblendet**. Ihre eigene Kategorie-Seite bleibt sichtbar. Existiert die Kategorie nicht, passiert nichts: kein Band und kein Ausschluss.

### Patterns (Kategorie „Fechtclub Kassel“)

| Pattern | Slug | Inhalt |
|---|---|---|
| FCK Hero | `fechtclub/hero` | Dunkler Startbereich mit Titel, Buttons, Bild |
| FCK Hero – Bild links | `fechtclub/hero-media` | Heller Bereich, Bild-Karte (verlinkt Vimeo-Video) + Text |
| FCK Was macht Fechten besonders | `fechtclub/besonders` | Dunkler Abschnitt, Button, drei Feature-Karten |
| FCK Vorstand-Karte (einzeln) | `fechtclub/vorstand-karte` | Foto, Name, Posten, E-Mail/Telefon |

### Block-Stile

- **Tabelle → „Stundenplan“** (`is-style-fck-stundenplan`): dunkle Kopfzeile, gebänderte Zeilen. Dafür muss in der Tabelle die Kopfzeile aktiviert sein.

### CSS-Klassen für den Editor

Diese Klassen kann man im Block-Editor unter *Block → Erweitert → Zusätzliche CSS-Klasse(n)* selbst vergeben. Die Patterns nutzen sie bereits.

| Klasse | Auf Block | Wirkung |
|---|---|---|
| `fck-eyebrow` | Absatz | Kleine Großbuchstaben-Zeile über einer Überschrift |
| `fck-button-ghost` | Button | Transparenter Button mit Rahmen (für dunkle Flächen) |
| `fck-bars-frame` | Gruppe mit Bild | Dunkle Hochformat-Karte mit Navy-Linien. Gedacht für ein freigestelltes Foto (transparentes PNG). |
| `fck-video-card` | Gruppe mit Bild | 16:9-Thumbnail mit Rundung und Schatten. Den Play-Button bringt das Bild selbst mit. |
| `fck-feature--koerper` / `--tradition` / `--wettkampf` | Spalte in `fck-features` | Feature-Karte mit dem jeweiligen Icon |
| `fck-vorstand` | Gruppe | Container einer Vorstandsseite: H3 als Gruppen-Überschrift, darunter Reihen |
| `fck-vorstand__row` | Spalten | Reihe von Vorstand-Karten |
| `fck-mail` / `fck-tel` | Link in der Karten-Beschriftung | Link mit Mail- bzw. Telefon-Icon |

### Templates

| Datei | Verwendung |
|---|---|
| `front-page.php` | Startseite: rendert die statische Startseite bündig (ohne Titelbanner) bzw. die Beitragsübersicht |
| `page.php` | Normale Seite mit Titelbanner und Lesespalte |
| `template-sections.php` | Seiten-Template **„Volle Breite (Abschnitte)“**: Titelbanner + vollbreite Block-Abschnitte (z. B. News-Seite) |
| `single.php` | Einzelbeitrag mit eigenem Kopf statt Titelbanner: erste Kategorie als Eyebrow, Titel, Datum, Beitragsbild (mit Lightbox). Darunter der Button „Mehr *Titel der News-Seite*“ |
| `index.php` | Blog-Übersicht, Archive, Suche, 404 |
| `template-parts/page-header.php` | Titelbanner der Unterseiten |
| `template-parts/content-teaser.php` | Beitragskarte (Blog-Übersicht **und** News-Block) |

### Customizer (Design → Customizer)

- **Header-Button:** Beschriftung und Zielseite (Fallback: `/probetraining`)
- **News:** News-Seite als Ziel des „Mehr News“-Buttons auf Einzelbeiträgen (Fallback: Beitragsseite aus *Einstellungen → Lesen*)
- **Footer:** Copyright-Zeile
- **Website-Informationen:** Logo für den Header (`custom-logo`). Ist keins gesetzt, nimmt der Header `assets/fck-logo.svg`. Das weiße Footer-Logo (`assets/fck-logo-weiss.svg`) ist fest im Theme und nicht über den Customizer änderbar.

### Sonstiges Verhalten

- Menüpositionen: **Hauptnavigation** (`primary`, 2 Ebenen) und **Footer-Navigation** (`footernav`, 1 Ebene)
- Unter 860 px Breite klappt die Hauptnavigation ein (`nav.js`). Ohne JavaScript wird das Menü gestapelt angezeigt.
- **Auszug bei Seiten** ist aktiviert und erscheint als Eyebrow (kleine Zeile über dem Titel) im Titelbanner
- **Lightbox** („Beim Klick vergrößern“) ist automatisch aktiv, aber nur für Bild-Blöcke in Einzelbeiträgen. Eine Einstellung pro Bild im Editor hat Vorrang.
- **12 Beiträge pro Seite** in Blog-Übersicht und Archiven
- `assets/css/main.css` wird auch im Editor geladen, damit Patterns dort ähnlich aussehen wie auf der Website
- Fonts (Inter, Archivo) liegen lokal im Theme. Es werden keine externen Requests an Google Fonts o. ä. gestellt.

---

## Aufbau

```
style.css            Theme-Header (Version!), sonst leer
theme.json           Design-Tokens: Farbpalette, Schriften, Größen, Abstände
functions.php        Supports, Menüs, Blöcke, Block-Stil, Customizer, Query-Anpassungen
assets/css/main.css  Das eigentliche Styling
assets/js/nav.js     Mobiler Menü-Toggle
assets/fonts/        Inter + Archivo (woff2, SIL OFL 1.1)
assets/decor/        SVG-Dekor (Linien, Wellen …)
assets/icons/        Icons der Feature-Karten
blocks/<name>/       block.json + index.js (Editor) + render.php (Ausgabe)
patterns/            Block-Patterns
template-parts/      Wiederverwendbare Template-Teile
```

---

## Hinweise bei Änderungen

- **Version hochzählen**, sonst gibt es kein Update. Assets (CSS/JS) werden dagegen über den Datei-Zeitstempel versioniert (`fck_asset_version()`), Browser laden sie also nach jeder Änderung automatisch neu.
- **Patterns sind Kopiervorlagen.** Was eingefügt wurde, liegt danach als normaler Block-Inhalt in der Datenbank. Wenn du eine Pattern-Datei änderst, **ändert das bestehende Seiten nicht**. Nur das CSS wirkt rückwirkend.
- **CSS-Klassen nicht umbenennen.** Patterns und Inhalte in der Datenbank verwenden Klassen wie `fck-section`, `fck-hero`, `fck-feature--koerper` oder `is-style-fck-stundenplan`. Wer eine Klasse in `main.css` umbenennt oder entfernt, zerschießt das Layout bestehender Seiten.
- **Farb-Slugs in `theme.json` nicht umbenennen** (`base`, `contrast`, `accent-1` … `ink`). Inhalte speichern die Slugs, z. B. `has-ink-background-color`. Farbwerte ändern ist unproblematisch.
- **Blocknamen (`fechtclub/news`, `fechtclub/ankuendigung`) und Attributnamen nicht ändern.** Sonst kennt WordPress die vorhandenen Blöcke nicht mehr. Neue Attribute brauchen einen Default.
- **Theme-Ordner nicht umbenennen.** Customizer-Einstellungen, Menüzuordnungen und Logo hängen am Ordnernamen (Theme-Slug) und wären danach weg.
- **Text-Domain** ist `fechtclub`. Neue Strings bitte mit `__( '…', 'fechtclub' )`.
- Der Slug der Ankündigungs-Kategorie lässt sich per Filter `fck_announcement_category_slug` ändern.
- **Feste Pfade:** `/probetraining` (Fallback im Header, Patterns `hero` und `besonders`) und `/mitglied-werden` (Pattern `hero`). Wenn sich die Seiten-Slugs ändern, laufen diese Links ins Leere. In bereits eingefügten Patterns muss man sie dann von Hand im Inhalt anpassen.
- Der Button-Stil `is-style-secondary` existiert nur im CSS und ist nicht als Block-Stil registriert. Im Editor taucht er deshalb nicht unter *Stile* auf. Für eigene Buttons `fck-button-ghost` verwenden.
- **Funktionen gehören nicht ins Theme.** Formulare, eigene Post-Typen, Shortcodes usw. kommen in ein eigenes Plugin, damit sie einen Theme-Wechsel überleben.

---

## Lizenz

Code: **GPL-2.0-or-later**, siehe [LICENSE](LICENSE).

Ausgenommen sind:
- **Logo und Bilder** (`assets/fck-logo*.svg`, `assets/fck-swords.svg`, `assets/img/`): © Fechtclub Kassel e.V., alle Rechte vorbehalten
- **Schriften** Inter und Archivo: SIL Open Font License 1.1, siehe `assets/fonts/LICENSE-*.txt`
