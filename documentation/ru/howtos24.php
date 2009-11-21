<?php
# dvdisaster: English homepage translation
# Copyright (C) 2004-2009 Carsten Gnörlich
#
# UTF-8 trigger: äöüß 
#
# Include our PHP sub routines, then call begin_page()
# to start the HTML page, insert the header, 
# navigation and news if appropriate.

require("../include/dvdisaster.php");
require("../include/footnote.php");
begin_page();

howto_headline("Создание файлов для исправления ошибок", "Архивация", "images/create-icon.png");
?>

<!--- Insert actual page content below --->
<h3>Советы по архивации файлов для исправления ошибок</h3>

CD/DVD/BD являются теперь одними из наиболее эффективных по стоимости сменных
носителей для хранения больших объемов информации. Поэтому вы, вероятно, рассматриваете их использование для хранения файлов для исправления ошибок.<p>

В этом нет ничего плохого, но учтите, что ваши данные и защитные файлы для
исправления ошибок хранятся на носителях с одинаковой надежностью.
Когда вы столкнетесь с ошибками чтения на носителях с данными, 
то вероятно, что и носитель, на котором находятся соответствующие файлы для исправления ошибок,
тоже стал поврежденным. В конце концов, оба носителя были записаны в одно время и у них
одинаковые характеристики старения.
<p>

<table width=100%><tr><td bgcolor=#000000 width=2><img width=1 height=1 alt=""></td>
<td>&nbsp;</td>
<td>Это может быть неожиданным, но нельзя гарантировать, что 
файл для исправления ошибок останется пригодным, если он хранится на поврежденном носителе.
Смотрите в старой документации <a href="http://dvdisaster.net/legacy/en/background20.html">разъяснение технической подоплёки</a>.
</td></tr></table><p>

Следовательно, важно защищать файлы для исправления ошибок так, как если бы это были
обычные данные. Говоря конкретнее,  
носитель, содержащий файлы для исправления ошибок, тоже должен быть защищен 
данными для исправления ошибок. Вот два способа сделать это:


<ol>
<li>Хранение файлов для исправления ошибок на отдельных носителях:<p>

Используйте дополнительные носители только для файлов с данными для исправления ошибок.
Если под файлы для исправления ошибок используется не более 80% носителя,
он может быть
<a href="howtos30.php">дополнен данными для исправления ошибок</a>. 
Это позволит восстановить носитель, если потом возникнут проблемы при
чтении файлов для исправления ошибок.<p></li>

<li>Хранение файлов для исправления ошибок на следующем в последовательности носителе:<p>

Возможно, вы используете носители для инкрементального резервного копирования. В таком случае 
можно накапливать файлы, пока не будет заполнен первый носитель.
Запишите этот носитель, как обычно, и создайте для него файл для исправления ошибок.
Включите этот файл в набор файлов для резервирования, предназначенный для 
второго носителя. Когда будет записан второй носитель, запишите
его файл для исправления ошибок на третий носитель и так далее. 
Таким способом все носители в этой цепочке защищены файлами 
для исправления ошибок (причем ecc-файл для последнего носителя находится на жестком диске, пока
не будет записан еще один носитель).<p>

Конечно, может грянуть закон Мэрфи, и в результате все носители в цепочке
окажутся поврежденными. В таком случае вам потребуется восстанавливать все носители, начиная
с самого последнего ;-)
</li>
</ol>

<!--- do not change below --->

<?php
# end_page() adds the footer line and closes the HTML properly.

end_page();
?>
