<?php
# dvdisaster: Russian homepage translation
# Copyright (C) 2007-2009 Igor Gorbounov
#
# UTF-8 trigger: äöüß 
#
# Include our PHP sub routines, then call begin_page()
# to start the HTML page, insert the header, 
# navigation and news if appropriate.

require("../include/dvdisaster.php");
begin_page();
?>

<!--- Insert actual page content below --->

<h3>Сообщения об ошибках</h3>

<a href="#tao">3.1 "Предупреждение: 2 секторов не хватает в конце диска".</a><p>
<a href="#block">3.2 Программа блокируется сразу после запуска.</a><p>
<a href="#crc">3.3 Что означает "CRC-ошибка, сектор: n"?</a><p>
<a href="#rw">3.4 Ошибки чтения или неправильный размер образа в случае носителей -RW/+RW/-RAM</a><p>
<a href="#dvdrom">3.5 Записанные мною носители распознаются как "DVD-ROM" и отвергаются.</a><p>
<a href="#freebsd">3.6 Не появляются устройства в FreeBSD.</a><p>
<a href="#v40error">3.7 "Ecc-файл создан версией 0.40.7."</a><p>

<hr><p>

<b><a name="tao">3.1 "Предупреждение: 2 секторов не хватает в конце диска"</a></b><p>
Это предупреждение появляется в случае носителей CD, записанных в режиме "TAO" (дорожка целиком).
Некоторые приводы сообщают размер образа, который на 2 сектора больше, чем должно быть для таких носителей,
что дает 2 ложных ошибки чтения в конце носителя, 
что <i>не</i> означает потерю данных в этом случае.<p>

Поскольку режим записи невозможно определить по носителю, dvdisaster предполагает,
что это CD в режиме "TAO", если точно два последних сектора не читаются, и обрезает образ
соответственно. Вам решать, правильно ли это. Вы можете
посоветовать программе dvdisaster обращаться с этими секторами как с реальными ошибками чтения, используя параметр
--dao, указав это 
на вкладке настроек для чтения/проверки.<p>

Чтобы избежать этих проблем, подумайте об использовании режима "DAO / Диск целиком" (иногда
также называемого "SAO / Сессия целиком") для записи односессионных носителей. 
<div align=right><a href="#top">&uarr;</a></div>


<b><a name="block">3.2 Программа блокируется сразу после запуска</a></b><p>
В старых версиях Линукса (ядро 2.4.x) программа иногда  
блокируется сразу после запуска и прежде, чем будут выполнены какие-либо
действия. Она не завершается с помощью Ctrl-C или "kill -9".<p>

Извлеките носитель, чтобы заставить программу завершиться. Вставьте носитель снова
и подождите, пока привод не распознает носитель и не остановит вращение.
Повторный запуск dvdisaster теперь должен сработать.
<div align=right><a href="#top">&uarr;</a></div>

<b><a name="crc">3.3 Что означает "CRC-ошибка, сектор: n"?</a></b><p>
Этот сектор может быть прочитан, но контрольная сумма его содержимого не
совпадает со значением, отмеченном в в файле коррекции ошибок.  Некоторые из возможных причин:<p>

<ul>
<li>Образ был смонтирован с разрешением для записи и
был, следовательно, изменен (типичный признак: CRC-ошибки в секторе 64 и в
секторах с 200 по 400).</li>
<li>В компьютере есть аппаратные проблемы, в особенности при
работе с устройствами хранения данных.</li>
</ul>


Если вы подозреваете технические проблемы, попробуйте создать еще одну версию образа 
и файла коррекции ошибок и <a href="howtos50.php">еще раз проверьте
их</a>.
Если ошибка исчезает или находится в другом месте,
у вашего компьютера может быть дефектная память, 
поврежденные интерфейсные кабели, или неправильные настройки частоты CPU/системы.
<div align=right><a href="#top">&uarr;</a></div>


<b><a name="rw">3.4 Ошибки чтения или неправильный размер образа в случае носителей -RW/+RW/-RAM</a></b><p>

Некоторые приводы сообщают неправильные размеры образов, когда используются носители -RW/+RW/-RAM. Два распространенных
случая:<p>

<table>
<tr><td valign="top">Проблема:</td>
<td>Привод сообщает размер самого большого образа, когда-либо записанного на носитель, а не 
размер фактического образа.
</td></tr>
<tr><td valign="top">Симптомы:</td>
<td>После стирания носителя на него записывается файл размером около 100 Мб.
Но прочитанный образ имеет размер в несколько Гб и содержит остатки 
старых образов.
</td></tr>
<tr><td><pre> </pre></td><td></td></tr>
<tr><td valign="top">Проблема:</td>
<td>Привод сообщает максимально возможную вместимость носителя (обычно 2295104 секторов)
вместо числа фактически использованных секторов.
</td></tr>
<tr><td valign="top">Симптомы:</td>
<td>При чтении за определенной точкой на носителе имеют место только ошибки чтения,
но все файлы все еще читаются, и они целые.
</td></tr>
</table><p>

Возможный выход из положения:<p>

<table width=100%><tr><td bgcolor=#000000 width=2><img width=1 height=1 alt=""></td><td>
Включите параметр для определения
размера образа из файловой системы ISO/UDF или файла ECC/RS02.
</td></tr></table><p>

Если требуемые сектора ISO/UDF нечитаемые, и вы используете файлы коррекции ошибок
для восстановления поврежденных носителей, то есть два возможных выхода из положения:

<ul>
<li>Выполните функцию <a href="howtos50.php">"Проверить"</a> так, чтобы только
файл коррекции ошибок был выбран/дан. Запишите правильный размер образа 
из выходных данных и ограничьте 
диапазон чтения соответственно.
</li>
<li>Просто считайте образ с неправильным (большим, чем надо) размером.
При запуске функции <a href="howtos40.php#repair">"Исправить"</a>
ответьте "OK" на вопрос, следует ли обрезать образ.
</li>
</ul>

<div align=right><a href="#top">&uarr;</a></div>

<b><a name="dvdrom">3.5 Записанные мною носители распознаются как "DVD-ROM" и отвергаются.</a></b><p>

Вероятно, тип носителя (book type) установлен в "DVD-ROM". Обычно для обработки
носителя в dvdisaster требуется привод, способный писать на носитель того же формата.<p>

Например, двухслойный DVD+R с неправильным типом носителя 
может быть принят только пишущим приводом, который может писать на такие носители.<p>

Попробуйте другой привод для чтения образов в этих случаях.

<div align=right><a href="#top">&uarr;</a></div>


<b><a name="freebsd">3.6 Не появляются устройства в FreeBSD.</a></b><p>

<ul>
<li>FreeBSD может потребоваться <a href="download10.php#freebsd">перекомпиляция ядра</a>,
чтобы ATAPI-приводы (почти все современные модели) можно было использовать
с dvdisaster.
<li>Вам нужны права на чтение и запись для соответствующего устройства
(например, /dev/pass0).
</ul>

<div align=right><a href="#top">&uarr;</a></div>


<b><a name="v40error">3.7 "Ecc-файл создан версией 0.40.7."</a></b><p>

<a href="http://sourceforge.net/cvs/?group_id=157550">CVS-версии</a>
dvdisaster помечают свои ecc-файлы специальным битом. Это является причиной того,
что dvdisaster до версии 0.65 ошибочно выдает вышеприведенное сообщение об ошибке. Используйте
CVS-версии только совместно с dvdisaster версии 0.66 или новее.

<div align=right><a href="#top">&uarr;</a></div>

<!--- do not change below --->

<?php
# end_page() adds the footer line and closes the HTML properly.

end_page();
?>
