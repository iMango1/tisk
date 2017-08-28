=== Woo GoPay ===
Requires at least: 3.8
Tested up to: 4.5
Stable tag: 1.0.0
License: 
License URI: 

== Popis ==
* Plugin umožňuje využívat platební bránu GoPay 

== Instalace ==
* Plugin je možné nainstalovat pomocí FTP, nebo nahráním Zip souboru v administraci

= Minimální požadavky =
* WordPress 4.0 nebo vyšší
* PHP version 5.6 nebo vyšší
* MySQL version 5.0 nebo vyšší

== Changelog ==

= 2.2.2 =
* Opraveno chování filtru gopay_order_id, při jeho nepoužití

= 2.2.1 =
* Upravena funkčnost předávání dat na GoPay, při response a notfikaci, s ohledem na použití filtru gopay_order_id

= 2.2.0 =
* Doplněna funkce, kdy, při použití pluginu WPML, bude návratová url, respektovat zvolený jazyk.
* Opravena nekompatibilita a konflikt, při používání nastavení menu v administraci

= 2.1.9 =
* Zpětná kompatibilita reduce stock pro WooCommerce 2.6

= 2.1.8 =
* Po zrušení objednávky zákazníkem se upraví stav na failed, ne na cancelled - aby bylo možné znovu zaplatit

= 2.1.7 =
* Úprava chování po zrušení objednávky
* Snížení stavu skladu až po návratu z GoPay, dle stavu platby

= 2.1.6 =
* Úprava detekce vybranné dopravní metody z ohledem na zpětnou kompatibilitu

= 2.1.5 =
* Úprava kontroly povolené dopravní metody z ohledem na zpětnou kompatibilitu

= 2.1.4 =
* Pokud není povolená žádná dopravní metoda, vrátí podmínka true - zpětná kompatibilita pro dopravní metody, které nejsou aktualizované pro dopravní zóny.

= 2.1.3 =
* Oprava aktivní platební metody

= 2.1.2 =
* Oprava získání statusu objednávky pro verze 2.6+

= 2.1.1 =
* Aktualizace tříd pro kompatibilitu s WooCommerce 3.0.+

= 2.1.0 =
* Doplněny třídy, pro kompatibilitu s WooCommerce 3.0.+
* Změněna testovací url na novou verzi
* Přidána podpora pro doručovací adresu

= 2.0.9 =
* Upraven kód, pro kompatibilitu s WooCommerce 3.0.+

= 2.0.8 =
* Oprava překlepu u detekce subsription

= 2.0.7 =
* Změna stavu objednávky, při zrušení zákazníkem, na cancelled

= 2.0.6 =
* Detekce měny nahrazena metodou get_order_currency()
* Přidána ochrana proti provedení notifikace dříve než odpovědi z brány
* Změna zadání ceny objednávky 
* Odstranění metody get_eshop_currency()
* Odstranění metody get_wpml_currency()
* Odstranění metody get_gopay_payment_price()
* Odstranění metody get_woocs_price()
* Přidán custom field gopay-response-message pro uložení exception při response

= 2.0.5 =
* fixed invalid argument in GoPay payment class

= 2.0.4 =
* fixed fatal error in 2.0.3 version

= 2.0.3 =
* fixed invalid argument in user account

= 2.0.2 =
* filter gopay_create_payment_product_name pro název produktu u objednávky
* oprava nadpisu u formuláře pro licenční klíč

= 2.0.1 =
* Oprava nastavení stavu objednávky opětovné platby u selhané objednávky
* Přesun přenosu čísla oobjednávky z WooCommerce do položky p2
* Nový filter gopay_order_id, umožňující manipulaci s optickým číslem objednávky
* Do kontroly notifikace byly přidány i objednávky ve stavu Zpracovává se

= 2.0.0 =
* Kompatibilita s PHP 7.0
* Omezení načítání js a css pouze na stránku pokladny
* Odstraněna metoda gopay_thankyou_locate_template
* Nová metoda get_woocs_price pro kompatibilitu s pluginem WOOCS
* Nová třída Toret_GoPay_Define 
* Nová metoda gopay_payment_methods třídy Toret_GoPay_Define
* Nová metoda gopay_card_methods třídy Toret_GoPay_Define
* Nová metoda get_gopay_payment_methods třídy Toret_GoPay_Define
* Nová metoda check_subscription_payment třídy Toret_GoPay_Define, pro kontrolu notifikace Subscription
* Nová metoda get_woocs_price třídy Toret_GoPay_Define
* Vytvoření nové tabulky v databázi, pro ukládání informací - gopay_log
* Nová třída Toret_GoPay_Log 
* Nová metoda save třídy Toret_GoPay_Log
* Nová metoda get_all_logs třídy Toret_GoPay_Log
* Refaktoring notifikačního scriptu
* Uložení dat notifikace do databáze logu
* Nová metoda get_cart_content třídy WC_Gateway_Woo_GoPay 
* Nová metoda get_subscription_date třídy WC_Gateway_Woo_GoPay 
* Nová metoda get_recurrence_cycle třídy WC_Gateway_Woo_GoPay 
* Odstranění funkce woocommerce_gopay_notify
* Odstranění metody enqueue_admin_scripts v administraci
* Přidány css styly pro výpis tabulky logu
* Na stránce menu Woo GoPay doplněn výpis logu
* Odstraněno nastavení card methods
* Odebrání souborů notify_log.txt a souborů response_log.txt
* Nový filter toret_gopay_payment_methods pro přejmenování platebních metod
* Přidán hook gopay_notify_virtual_product_status 
* Přidán hook gopay_notify_normal_product_status 
* Přidán hook gopay_notify_payment_method_chosen 
* Přidán hook gopay_notify_payment_created 
* Přidán hook gopay_notify_payment_canceled 
* Přidán hook gopay_notify_payment_timeouted 
* Přidán hook gopay_notify_payment_authorized
* Přidán hook gopay_notify_payment_refunded 
* Přidán hook gopay_notify_payment_failed 
* Přidán hook gopay_checkout_enabled_methods

= 1.7.0 =
* Doplnění platebních metod o PayPal a SUPERCASH
* Doplnění nastavení o možnost řazení robrazení platebních metod
* Defaultně zaškrtnuta první metoda v seznamu

= 1.6.3 =
* nahrazení soft deprecated funkcí a metod

= 1.6.2 =
* Změna stavu objednávky na pending, pokud je odpověď GoPay PAYMENT_METHOD_CHOSEN
* Přidání výsledku kontroly virtuálních produktů v objednávce do logu
* Změna volání nestatické metody get_checkout_order_received_url v response.php

= 1.6.1 =
* Kompatibilita s pluginem WooCommerce Pre Order
* Změna volání nestatické metody get_checkout_order_received_url v třídě brány
* Přidána kontrola existence třídy WC_Pre_Orders_Order

= 1.6.0 - 20.11. 2015 =
* Oprava drobných chyb

= 1.5.8 - 17.11. 2015 =
* Doplnění ochrany, proti zpracování notifikace před odpovědí brány

= 1.5.7 - 15.11. 2015 =
* Nahrazena zastaralá metoda get_checkout_payment_url

= 1.5.6 - 7.10. 2015 =
* Přidána metoda get_eshop_currency pro získání měny eshopu
* Přidána metoda get_eshop_lang pro získání jazyka eshopu
* Odstraněna metoda get_currency_and_lang_data
* Přidána možnost vyvolání platební brány ve Slovenském jazyce

= 1.5.5 - 30.08. 2015 =
* Zmena notifikační url na http://vas-eshop.cz/?gopay=notify

= 1.5.4 - 05.08. 2015 =
* Refaktoring metody is_available třídy platební brány
* Přidána metoda get_choosen_shipping_method třídy platební brány
* Přidána metoda check_method třídy platební brány
* Metoda is_available_for_country třídy platební brány nyní vraci true, pokud je nastavení povolených zemí prázdné
* Platební brána je nyní dostupná pro všechny země, pokud není v nastavení zadáno omezení 

= 1.5.3 - 22.04. 2015 =
* Formulář pro zadání licenčního klíče byl přesunut do submenu Toret plugins
* Upraveno oprávnění nastavení pluginu i pro managera obchodu

= 1.5.2 - 22.04. 2015 =
* Upraveno získávání celkové částky objednávky v notify

= 1.5.1 - 15.04. 2015 =
* Přidána podpora WooCommerce Subscription pluginu

= 1.5.0 - 15.04. 2015 =
* Upravený chybný parametr order v notify a response
* Přidána metoda get_wpml_currency do class-wc-gateway-gopay.php
* Přidána metoda get_currency_and_lang_data do class-wc-gateway-gopay.php
* Detekce a výpočet ceny objednávky na základě nastavení WooCommerce multicurrency switcher pluginu

= 1.4.5 - 13.04. 2015 =
* Odstraněno chybné přesměrování
 
= 1.4.4 - 09.04. 2015 =
* Odstraněna chybná kontrola existence Multicurrency switcher pluginu

= 1.4.3 - 09.04. 2015 =
* Přidán aktualizační script

= 1.4.2 - 02.04. 2015 =
* Upraveno přepínaní měn pomocí WPML WooCommerce Currency nezávisle na zvoleném jazyku
* Doplněna podpora pro Multi Currency Switcher plugin a přepínání měn 

= 1.4.1 - 20.03. 2015 =
* Změna konstanty CALLBACK_URL na GOPAY_CALLBACK_URL z důvodu kofliktu s jiným pluginem
* Přidána možnost omezení platební metody na určité země
* Možnost zvolit metodu platební karty - pokud není zvolený správný poskytovatel, GoPay neomezí výběr pouze na platební kartu
* Přidáno vypnutí výběru platebních metod, ponechána pouze platební karta - výběr se nezobrazuje
* Doplněno ukládání nekorektních informací do response a notify log
* Změna stavu vytvořené, ale nezaplacené platby na on-hold
* notify listener přesunut z woocommerce-gopay.php do class-wc-gateway-gopay.cz

= 1.4.0 - 20.03. 2015 =
* Přidán po README.txt soubor pro zapisování změn