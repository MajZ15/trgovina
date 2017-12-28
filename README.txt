# Za delovanje preusmeritev na nivoju strežnika Apache moramo
# vklopiti modul rewrite. To naredimo z naslednjim ukazom

sudo a2enmod rewrite

# V datoteko /etc/apache2/sites-available/000-default.conf
# pod vrstico Alias /netbeans... dodamo spodnjo vsebino

Alias /netbeans/ "/home/ep/NetBeansProjects/"
<Directory /home/ep/NetBeansProjects/>
        Require all granted
        AllowOverride All
</Directory>

# Enako vsebino dodamo v konfiguracijo datoteko, ki v Apacheju določa strežbo 
# datoteko po protokolu SSL (default-ssl.conf)

Zaenkrat le izpiše vse artikle trgovine


UPDATE 28.12.2017 0:21

Dodani so REST viri za:
    - narocilo
    - artikel
    - admin
    - stranka
    - prodajalec 

Testirani so vsi z Insomnio in delajo.

? Testiranje z Postman iz Windows je neuspešno pri metodah PUT in POST ? ("Missing data.") ? 
/*
$_myPOST = [];
parse_str(file_get_contents("php://input"), $_myPOST);
$data = filter_var_array($_myPOST, self::getRules());
...
v primeru z Postman so vse vredosti $data = null ? 
če je JSON v obliki npr. pri 
POST localhost/netbeans/trgovina/prodajalci
{
    "ime" = "Janez",
    "priimek" = "Novak",
    "email" = "janez.novak@gmail.com",
    "geslo" = "geslo",
    "admin_idadmin" = "1"
}
če je pa JSON v obliki
ime=Janez&priimek=Novak&email=janez.novak@gmail.com&geslo=geslo&admin_idadmin=1
Pa dela ? 
*/      

Posodobljena baza -> dodan atribut 'kolicina' k entiteti narocilo in artikel (?artikel_has_stranka?)
? Narocilo nima podatka o tem, kateri artikel je narocen ? 