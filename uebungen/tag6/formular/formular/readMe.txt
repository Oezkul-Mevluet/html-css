Hier gibt es 2 verschiedene Arten die Daten eines Formulars mit der PHP mail() Funktion zu verschicken.

1)
Diese Methode benötigt folgende Dateien:
email.html, send_email.php, ok.html, fehler.html
In email.hmtl ist ein Formular welches die Daten an die Datei send_email.php verschickt.
In send_email.php werden die Daten empfangen und per mail() Funktion verschickt.
Bei erfolgreichem Versenden wird die Seite ok.html geladen, andernfalls fehler.html

In der Datei send_mail.php müssen in den ersten 12 Zeilen einige Anpassungen vorgenommen werden (siehe Kommentar).
Ein Vorteil dieser Methode ist, dass man das Formular auf email.html beliebig verändern kann, indem man Felder hinzufügt oder entfernt. Es ist nicht nötig in der send_mail.php das PHP-Script dahingehend anzupassen. Alle Formularfelder werden automatisch verarbeitet.

2)
siehe auch:
https://www.w3schools.com/php/php_form_url_email.asp
Diese Methode benötigt die Datei:
email2.php
Dieses Emailformular benötigt keine weiter PHP Seite. Das Verschicken erfolgt auf dieser Seite.
Es werden Hinweise ausgegeben, wenn Pflichtfelder nicht ausgefüllt werden und wenn die Seite erfolgreich versand wurden, bzw. wenn beim Versand ein Fehler aufgetreten ist. Verändert man das Formular muss auch das PHP Script angepasst werden.
