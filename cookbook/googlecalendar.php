<?php if (!defined('PmWiki')) exit();
/**
  GoogleCalendar - Embeds a Google Calendar in a PmWiki page, for PmWiki 2.x
  Based on the original .php code written by zkarj (2006)

  Copyright 2006-2016 by zkarj (arj -a@t- zkarj -dott- co -dot- nz)
  Addapted by Felipe Gonzalez-Cataldo on 2016 (fgonzalez [at] lpmd [dot] cl)
    
  This text is written for PmWiki; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version. See pmwiki.php for full details
  and lack of warranty.
*/
$RecipeInfo['GoogleCalendar']['Version'] = '2016-02-09';


Markup('GoogleCalendar', 'directives',  '/\\(:GoogleCalendar (.*?):\\)/e', 'DspGCal("$1")');

function DspGCal($opts) {
  $args = ParseArgs($opts);

  if (!$args['calendar']) { $output = "Undefined Google Calendar"; }
    else { // valid calendar
  $args['calendar'] = str_replace("@","%40",$args['calendar']);  

  # DEFAULT VALUES
  # Variables:
  #    title, control, mode, width, height, items, week, bgcolor, border 
  if (!$args['title']) { $args['title'] = 'My%20Calendar'; }
    else { $args['title'] = str_replace(" ","%20",strip_quotes($args['title'])); }

  if ($args['control'] != 'full'
    && $args['control'] != 'navonly'
    && $args['control'] != 'none') { $args['control'] = 'full'; }

  if ($args['mode'] != 'month'
    && $args['mode'] != 'week'
    && $args['mode'] != 'agenda') { $args['mode'] = 'month'; }

  if (!$args['width']) { $args['width'] = '640'; }

  if (!$args['height']) { $args['height'] = '610'; }

  if (!$args['items']) { $args['items'] = '5'; }

  if ($args['week'] != 'Sun'
     && $args['week'] != 'Mon'
     && $args['week'] != 'Sat') { $args['week'] = 'Sun'; }

  if ($args['border'] != 'on'
    && $args['border'] != 'off') { $args['border'] = 'off'; }

  if ($args['date'] != 'on'
    && $args['date'] != 'off') { $args['date'] = 'on'; }

  if ($args['print'] != 'on'
    && $args['print'] != 'off') { $args['print'] = 'on'; }

  if ($args['tabs'] != 'on'
    && $args['tabs'] != 'off') { $args['tabs'] = 'on'; }

  if ($args['showcals'] != 'on'
    && $args['showcals'] != 'off') { $args['showcals'] = 'on'; }

  if ($args['showTz'] != 'on'
    && $args['showTz'] != 'off') { $args['showTz'] = 'on'; }


  # SETTING VALUES
  #    title, control, mode, width, height, items, week, bgcolor, border 
  $output  = '<iframe src="http://www.google.com/calendar/embed?';
  $output .= 'src=' . $args['calendar'];  # <-- MAIN CALENDAR
  $output .= '&title=' . $args['title'];

  # <-------------------------------------------------------------------> #
  if ($args['control'] == 'navonly') { $output .= '&chrome=NAVIGATION'; }
        elseif ($args['control'] == 'none') { $output .= '&chrome=NONE&showNav=0'; }

  if ($args['mode'] == 'agenda') { $output .= '&mode=AGENDA'; }
    elseif ($args['mode'] == 'week') { $output .= '&mode=WEEK'; }

  $output .= '&epr=' . $args['items'];

  $output .= '&wkst=';
  if ($args['week'] == 'Sun') { $output .= '1'; }
    elseif ($args['week'] == 'Mon') { $output .= '2'; }
    else  { $output .= '7'; }

  $output .= '&height=' . $args['height'];

  if ($args['bgcolor']) { $output .= '&bgcolor=%23' . str_replace('#','',$args['bgcolor']); }

  # LANGUAGES (for references, visit https://sites.google.com/site/tomihasa/google-language-codes)
  if ($args['language'] == 'afrikaans') { $output .= '&hl=af'; }
    elseif ($args['language'] == 'akan') { $output .= '&hl=ak'; }
    elseif ($args['language'] == 'albanian') { $output .= '&hl=sq'; }
    elseif ($args['language'] == 'amharic') { $output .= '&hl=am'; }
    elseif ($args['language'] == 'arabic') { $output .= '&hl=ar'; }
    elseif ($args['language'] == 'armenian') { $output .= '&hl=hy'; }
    elseif ($args['language'] == 'azerbaijani') { $output .= '&hl=az'; }
    elseif ($args['language'] == 'basque') { $output .= '&hl=eu'; }
    elseif ($args['language'] == 'belarusian') { $output .= '&hl=be'; }
    elseif ($args['language'] == 'bemba') { $output .= '&hl=bem'; }
    elseif ($args['language'] == 'bengali') { $output .= '&hl=bn'; }
    elseif ($args['language'] == 'bihari') { $output .= '&hl=bh'; }
    elseif ($args['language'] == 'bork') { $output .= '&hl=xx_bork'; }
    elseif ($args['language'] == 'bosnian') { $output .= '&hl=bs'; }
    elseif ($args['language'] == 'breton') { $output .= '&hl=br'; }
    elseif ($args['language'] == 'bulgarian') { $output .= '&hl=bg'; }
    elseif ($args['language'] == 'cambodian') { $output .= '&hl=km'; }
    elseif ($args['language'] == 'catalan') { $output .= '&hl=ca'; }
    elseif ($args['language'] == 'cherokee') { $output .= '&hl=chr'; }
    elseif ($args['language'] == 'chichewa') { $output .= '&hl=ny'; }
    elseif ($args['language'] == 'chineseSimp') { $output .= '&hl=zh_CN'; }
    elseif ($args['language'] == 'chinese') { $output .= '&hl=zh_TW'; }
    elseif ($args['language'] == 'corsican') { $output .= '&hl=co'; }
    elseif ($args['language'] == 'croatian') { $output .= '&hl=hr'; }
    elseif ($args['language'] == 'czech') { $output .= '&hl=cs'; }
    elseif ($args['language'] == 'danish') { $output .= '&hl=da'; }
    elseif ($args['language'] == 'dutch') { $output .= '&hl=nl'; }
    elseif ($args['language'] == 'elmer') { $output .= '&hl=xx_elmer'; }
    elseif ($args['language'] == 'english') { $output .= '&hl=en'; }
    elseif ($args['language'] == 'englishUK') { $output .= '&hl=en_GB'; }
    elseif ($args['language'] == 'esperanto') { $output .= '&hl=eo'; }
    elseif ($args['language'] == 'estonian') { $output .= '&hl=et'; }
    elseif ($args['language'] == 'ewe') { $output .= '&hl=ee'; }
    elseif ($args['language'] == 'faroese') { $output .= '&hl=fo'; }
    elseif ($args['language'] == 'filipino') { $output .= '&hl=tl'; }
    elseif ($args['language'] == 'finnish') { $output .= '&hl=fi'; }
    elseif ($args['language'] == 'french') { $output .= '&hl=fr'; }
    elseif ($args['language'] == 'frisian') { $output .= '&hl=fy'; }
    elseif ($args['language'] == 'ga') { $output .= '&hl=gaa'; }
    elseif ($args['language'] == 'galician') { $output .= '&hl=gl'; }
    elseif ($args['language'] == 'georgian') { $output .= '&hl=ka'; }
    elseif ($args['language'] == 'german') { $output .= '&hl=de'; }
    elseif ($args['language'] == 'greek') { $output .= '&hl=el'; }
    elseif ($args['language'] == 'guarani') { $output .= '&hl=gn'; }
    elseif ($args['language'] == 'gujarati') { $output .= '&hl=gu'; }
    elseif ($args['language'] == 'hacker') { $output .= '&hl=xx_hacker'; }
    elseif ($args['language'] == 'haitian') { $output .= '&hl=ht'; }
    elseif ($args['language'] == 'hausa') { $output .= '&hl=ha'; }
    elseif ($args['language'] == 'hawaiian') { $output .= '&hl=haw'; }
    elseif ($args['language'] == 'hebrew') { $output .= '&hl=iw'; }
    elseif ($args['language'] == 'hindi') { $output .= '&hl=hi'; }
    elseif ($args['language'] == 'hungarian') { $output .= '&hl=hu'; }
    elseif ($args['language'] == 'icelandic') { $output .= '&hl=is'; }
    elseif ($args['language'] == 'igbo') { $output .= '&hl=ig'; }
    elseif ($args['language'] == 'indonesian') { $output .= '&hl=id'; }
    elseif ($args['language'] == 'interlingua') { $output .= '&hl=ia'; }
    elseif ($args['language'] == 'irish') { $output .= '&hl=ga'; }
    elseif ($args['language'] == 'italian') { $output .= '&hl=it'; }
    elseif ($args['language'] == 'japanese') { $output .= '&hl=ja'; }
    elseif ($args['language'] == 'javanese') { $output .= '&hl=jw'; }
    elseif ($args['language'] == 'kannada') { $output .= '&hl=kn'; }
    elseif ($args['language'] == 'kazakh') { $output .= '&hl=kk'; }
    elseif ($args['language'] == 'kinyarwanda') { $output .= '&hl=rw'; }
    elseif ($args['language'] == 'kirundi') { $output .= '&hl=rn'; }
    elseif ($args['language'] == 'klingon') { $output .= '&hl=xx_klingon'; }
    elseif ($args['language'] == 'kongo') { $output .= '&hl=kg'; }
    elseif ($args['language'] == 'korean') { $output .= '&hl=ko'; }
    elseif ($args['language'] == 'krio') { $output .= '&hl=kri'; }
    elseif ($args['language'] == 'kurdish') { $output .= '&hl=ku'; }
    elseif ($args['language'] == 'kurdishSorani') { $output .= '&hl=ckb'; }
    elseif ($args['language'] == 'kyrgyz') { $output .= '&hl=ky'; }
    elseif ($args['language'] == 'laothian') { $output .= '&hl=lo'; }
    elseif ($args['language'] == 'latin') { $output .= '&hl=la'; }
    elseif ($args['language'] == 'latvian') { $output .= '&hl=lv'; }
    elseif ($args['language'] == 'lingala') { $output .= '&hl=ln'; }
    elseif ($args['language'] == 'lithuanian') { $output .= '&hl=lt'; }
    elseif ($args['language'] == 'lozi') { $output .= '&hl=loz'; }
    elseif ($args['language'] == 'luganda') { $output .= '&hl=lg'; }
    elseif ($args['language'] == 'luo') { $output .= '&hl=ach'; }
    elseif ($args['language'] == 'macedonian') { $output .= '&hl=mk'; }
    elseif ($args['language'] == 'malagasy') { $output .= '&hl=mg'; }
    elseif ($args['language'] == 'malay') { $output .= '&hl=ms'; }
    elseif ($args['language'] == 'malayalam') { $output .= '&hl=ml'; }
    elseif ($args['language'] == 'maltese') { $output .= '&hl=mt'; }
    elseif ($args['language'] == 'maori') { $output .= '&hl=mi'; }
    elseif ($args['language'] == 'marathi') { $output .= '&hl=mr'; }
    elseif ($args['language'] == 'mauritian') { $output .= '&hl=mfe'; }
    elseif ($args['language'] == 'moldavian') { $output .= '&hl=mo'; }
    elseif ($args['language'] == 'mongolian') { $output .= '&hl=mn'; }
    elseif ($args['language'] == 'montenegrin') { $output .= '&hl=sr_ME'; }
    elseif ($args['language'] == 'nepali') { $output .= '&hl=ne'; }
    elseif ($args['language'] == 'nigerian') { $output .= '&hl=pcm'; }
    elseif ($args['language'] == 'northern') { $output .= '&hl=nso'; }
    elseif ($args['language'] == 'norwegian') { $output .= '&hl=no'; }
    elseif ($args['language'] == 'norwegianNynorsk') { $output .= '&hl=nn'; }
    elseif ($args['language'] == 'occitan') { $output .= '&hl=oc'; }
    elseif ($args['language'] == 'oriya') { $output .= '&hl=or'; }
    elseif ($args['language'] == 'oromo') { $output .= '&hl=om'; }
    elseif ($args['language'] == 'pashto') { $output .= '&hl=ps'; }
    elseif ($args['language'] == 'persian') { $output .= '&hl=fa'; }
    elseif ($args['language'] == 'pirate') { $output .= '&hl=xx_pirate'; }
    elseif ($args['language'] == 'polish') { $output .= '&hl=pl'; }
    elseif ($args['language'] == 'portuguese') { $output .= '&hl=pt_BR'; }
    elseif ($args['language'] == 'portuguesePT') { $output .= '&hl=pt_PT'; }
    elseif ($args['language'] == 'punjabi') { $output .= '&hl=pa'; }
    elseif ($args['language'] == 'quechua') { $output .= '&hl=qu'; }
    elseif ($args['language'] == 'romanian') { $output .= '&hl=ro'; }
    elseif ($args['language'] == 'romansh') { $output .= '&hl=rm'; }
    elseif ($args['language'] == 'runyakitara') { $output .= '&hl=nyn'; }
    elseif ($args['language'] == 'russian') { $output .= '&hl=ru'; }
    elseif ($args['language'] == 'scots') { $output .= '&hl=gd'; }
    elseif ($args['language'] == 'serbian') { $output .= '&hl=sr'; }
    elseif ($args['language'] == 'serbo-croatian') { $output .= '&hl=sh'; }
    elseif ($args['language'] == 'sesotho') { $output .= '&hl=st'; }
    elseif ($args['language'] == 'setswana') { $output .= '&hl=tn'; }
    elseif ($args['language'] == 'seychellois') { $output .= '&hl=crs'; }
    elseif ($args['language'] == 'shona') { $output .= '&hl=sn'; }
    elseif ($args['language'] == 'sindhi') { $output .= '&hl=sd'; }
    elseif ($args['language'] == 'sinhalese') { $output .= '&hl=si'; }
    elseif ($args['language'] == 'slovak') { $output .= '&hl=sk'; }
    elseif ($args['language'] == 'slovenian') { $output .= '&hl=sl'; }
    elseif ($args['language'] == 'somali') { $output .= '&hl=so'; }
    elseif ($args['language'] == 'spanish') { $output .= '&hl=es'; }
    elseif ($args['language'] == 'spanishLAT') { $output .= '&hl=es_419'; }
    elseif ($args['language'] == 'sundanese') { $output .= '&hl=su'; }
    elseif ($args['language'] == 'swahili') { $output .= '&hl=sw'; }
    elseif ($args['language'] == 'swedish') { $output .= '&hl=sv'; }
    elseif ($args['language'] == 'tajik') { $output .= '&hl=tg'; }
    elseif ($args['language'] == 'tamil') { $output .= '&hl=ta'; }
    elseif ($args['language'] == 'tatar') { $output .= '&hl=tt'; }
    elseif ($args['language'] == 'telugu') { $output .= '&hl=te'; }
    elseif ($args['language'] == 'thai') { $output .= '&hl=th'; }
    elseif ($args['language'] == 'tigrinya') { $output .= '&hl=ti'; }
    elseif ($args['language'] == 'tonga') { $output .= '&hl=to'; }
    elseif ($args['language'] == 'tshiluba') { $output .= '&hl=lua'; }
    elseif ($args['language'] == 'tumbuka') { $output .= '&hl=tum'; }
    elseif ($args['language'] == 'turkish') { $output .= '&hl=tr'; }
    elseif ($args['language'] == 'turkmen') { $output .= '&hl=tk'; }
    elseif ($args['language'] == 'twi') { $output .= '&hl=tw'; }
    elseif ($args['language'] == 'uighur') { $output .= '&hl=ug'; }
    elseif ($args['language'] == 'ukrainian') { $output .= '&hl=uk'; }
    elseif ($args['language'] == 'urdu') { $output .= '&hl=ur'; }
    elseif ($args['language'] == 'uzbek') { $output .= '&hl=uz'; }
    elseif ($args['language'] == 'vietnamese') { $output .= '&hl=vi'; }
    elseif ($args['language'] == 'welsh') { $output .= '&hl=cy'; }
    elseif ($args['language'] == 'wolof') { $output .= '&hl=wo'; }
    elseif ($args['language'] == 'xhosa') { $output .= '&hl=xh'; }
    elseif ($args['language'] == 'yiddish') { $output .= '&hl=yi'; }
    elseif ($args['language'] == 'yoruba') { $output .= '&hl=yo'; }
    elseif ($args['language'] == 'zulu') { $output .= '&hl=zu'; }
    else { $output .= '&hl=en'; }

  # TIMEZONES (for references, visit https://developers.google.com/adwords/api/docs/appendix/timezones) 
  if ($args['timezone'] == 'abidjan') { $output .= '&ctz=Africa/Abidjan'; }
    elseif ($args['timezone'] == 'accra') { $output .= '&ctz=Africa/Accra'; }
    elseif ($args['timezone'] == 'addisababa') { $output .= '&ctz=Africa/Addis_Ababa'; }
    elseif ($args['timezone'] == 'algiers') { $output .= '&ctz=Africa/Algiers'; }
    elseif ($args['timezone'] == 'asmera') { $output .= '&ctz=Africa/Asmera'; }
    elseif ($args['timezone'] == 'bamako') { $output .= '&ctz=Africa/Bamako'; }
    elseif ($args['timezone'] == 'bangui') { $output .= '&ctz=Africa/Bangui'; }
    elseif ($args['timezone'] == 'banjul') { $output .= '&ctz=Africa/Banjul'; }
    elseif ($args['timezone'] == 'bissau') { $output .= '&ctz=Africa/Bissau'; }
    elseif ($args['timezone'] == 'blantyre') { $output .= '&ctz=Africa/Blantyre'; }
    elseif ($args['timezone'] == 'brazzaville') { $output .= '&ctz=Africa/Brazzaville'; }
    elseif ($args['timezone'] == 'bujumbura') { $output .= '&ctz=Africa/Bujumbura'; }
    elseif ($args['timezone'] == 'cairo') { $output .= '&ctz=Africa/Cairo'; }
    elseif ($args['timezone'] == 'casablanca') { $output .= '&ctz=Africa/Casablanca'; }
    elseif ($args['timezone'] == 'ceuta') { $output .= '&ctz=Africa/Ceuta'; }
    elseif ($args['timezone'] == 'conakry') { $output .= '&ctz=Africa/Conakry'; }
    elseif ($args['timezone'] == 'dakar') { $output .= '&ctz=Africa/Dakar'; }
    elseif ($args['timezone'] == 'daressalaam') { $output .= '&ctz=Africa/Dar_es_Salaam'; }
    elseif ($args['timezone'] == 'djibouti') { $output .= '&ctz=Africa/Djibouti'; }
    elseif ($args['timezone'] == 'douala') { $output .= '&ctz=Africa/Douala'; }
    elseif ($args['timezone'] == 'elaaiun') { $output .= '&ctz=Africa/El_Aaiun'; }
    elseif ($args['timezone'] == 'freetown') { $output .= '&ctz=Africa/Freetown'; }
    elseif ($args['timezone'] == 'gaborone') { $output .= '&ctz=Africa/Gaborone'; }
    elseif ($args['timezone'] == 'harare') { $output .= '&ctz=Africa/Harare'; }
    elseif ($args['timezone'] == 'johannesburg') { $output .= '&ctz=Africa/Johannesburg'; }
    elseif ($args['timezone'] == 'kampala') { $output .= '&ctz=Africa/Kampala'; }
    elseif ($args['timezone'] == 'khartoum') { $output .= '&ctz=Africa/Khartoum'; }
    elseif ($args['timezone'] == 'kigali') { $output .= '&ctz=Africa/Kigali'; }
    elseif ($args['timezone'] == 'kinshasa') { $output .= '&ctz=Africa/Kinshasa'; }
    elseif ($args['timezone'] == 'lagos') { $output .= '&ctz=Africa/Lagos'; }
    elseif ($args['timezone'] == 'libreville') { $output .= '&ctz=Africa/Libreville'; }
    elseif ($args['timezone'] == 'lome') { $output .= '&ctz=Africa/Lome'; }
    elseif ($args['timezone'] == 'luanda') { $output .= '&ctz=Africa/Luanda'; }
    elseif ($args['timezone'] == 'lubumbashi') { $output .= '&ctz=Africa/Lubumbashi'; }
    elseif ($args['timezone'] == 'lusaka') { $output .= '&ctz=Africa/Lusaka'; }
    elseif ($args['timezone'] == 'malabo') { $output .= '&ctz=Africa/Malabo'; }
    elseif ($args['timezone'] == 'maputo') { $output .= '&ctz=Africa/Maputo'; }
    elseif ($args['timezone'] == 'maseru') { $output .= '&ctz=Africa/Maseru'; }
    elseif ($args['timezone'] == 'mbabane') { $output .= '&ctz=Africa/Mbabane'; }
    elseif ($args['timezone'] == 'mogadishu') { $output .= '&ctz=Africa/Mogadishu'; }
    elseif ($args['timezone'] == 'monrovia') { $output .= '&ctz=Africa/Monrovia'; }
    elseif ($args['timezone'] == 'nairobi') { $output .= '&ctz=Africa/Nairobi'; }
    elseif ($args['timezone'] == 'ndjamena') { $output .= '&ctz=Africa/Ndjamena'; }
    elseif ($args['timezone'] == 'niamey') { $output .= '&ctz=Africa/Niamey'; }
    elseif ($args['timezone'] == 'nouakchott') { $output .= '&ctz=Africa/Nouakchott'; }
    elseif ($args['timezone'] == 'ouagadougou') { $output .= '&ctz=Africa/Ouagadougou'; }
    elseif ($args['timezone'] == 'porto-novo') { $output .= '&ctz=Africa/Porto-Novo'; }
    elseif ($args['timezone'] == 'saotome') { $output .= '&ctz=Africa/Sao_Tome'; }
    elseif ($args['timezone'] == 'tripoli') { $output .= '&ctz=Africa/Tripoli'; }
    elseif ($args['timezone'] == 'tunis') { $output .= '&ctz=Africa/Tunis'; }
    elseif ($args['timezone'] == 'windhoek') { $output .= '&ctz=Africa/Windhoek'; }
    elseif ($args['timezone'] == 'alaskatime') { $output .= '&ctz=America/Anchorage'; }
    elseif ($args['timezone'] == 'anguilla') { $output .= '&ctz=America/Anguilla'; }
    elseif ($args['timezone'] == 'antigua') { $output .= '&ctz=America/Antigua'; }
    elseif ($args['timezone'] == 'araguaina') { $output .= '&ctz=America/Araguaina'; }
    elseif ($args['timezone'] == 'buenosaires') { $output .= '&ctz=America/Argentina/Buenos_Aires'; }
    elseif ($args['timezone'] == 'aruba') { $output .= '&ctz=America/Aruba'; }
    elseif ($args['timezone'] == 'asuncion') { $output .= '&ctz=America/Asuncion'; }
    elseif ($args['timezone'] == 'salvador') { $output .= '&ctz=America/Bahia'; }
    elseif ($args['timezone'] == 'barbados') { $output .= '&ctz=America/Barbados'; }
    elseif ($args['timezone'] == 'belem') { $output .= '&ctz=America/Belem'; }
    elseif ($args['timezone'] == 'belize') { $output .= '&ctz=America/Belize'; }
    elseif ($args['timezone'] == 'boavista') { $output .= '&ctz=America/Boa_Vista'; }
    elseif ($args['timezone'] == 'bogota') { $output .= '&ctz=America/Bogota'; }
    elseif ($args['timezone'] == 'campogrande') { $output .= '&ctz=America/Campo_Grande'; }
    elseif ($args['timezone'] == 'caracas') { $output .= '&ctz=America/Caracas'; }
    elseif ($args['timezone'] == 'cayenne') { $output .= '&ctz=America/Cayenne'; }
    elseif ($args['timezone'] == 'cayman') { $output .= '&ctz=America/Cayman'; }
    elseif ($args['timezone'] == 'centraltime') { $output .= '&ctz=America/Chicago'; }
    elseif ($args['timezone'] == 'costarica') { $output .= '&ctz=America/Costa_Rica'; }
    elseif ($args['timezone'] == 'cuiaba') { $output .= '&ctz=America/Cuiaba'; }
    elseif ($args['timezone'] == 'curacao') { $output .= '&ctz=America/Curacao'; }
    elseif ($args['timezone'] == 'danmarkshavn') { $output .= '&ctz=America/Danmarkshavn'; }
    elseif ($args['timezone'] == 'mountaintime-dawsoncreek') { $output .= '&ctz=America/Dawson_Creek'; }
    elseif ($args['timezone'] == 'mountaintime') { $output .= '&ctz=America/Denver'; }
    elseif ($args['timezone'] == 'dominica') { $output .= '&ctz=America/Dominica'; }
    elseif ($args['timezone'] == 'mountaintime-edmonton') { $output .= '&ctz=America/Edmonton'; }
    elseif ($args['timezone'] == 'elsalvador') { $output .= '&ctz=America/El_Salvador'; }
    elseif ($args['timezone'] == 'fortaleza') { $output .= '&ctz=America/Fortaleza'; }
    elseif ($args['timezone'] == 'godthab') { $output .= '&ctz=America/Godthab'; }
    elseif ($args['timezone'] == 'grandturk') { $output .= '&ctz=America/Grand_Turk'; }
    elseif ($args['timezone'] == 'grenada') { $output .= '&ctz=America/Grenada'; }
    elseif ($args['timezone'] == 'guadeloupe') { $output .= '&ctz=America/Guadeloupe'; }
    elseif ($args['timezone'] == 'guatemala') { $output .= '&ctz=America/Guatemala'; }
    elseif ($args['timezone'] == 'guayaquil') { $output .= '&ctz=America/Guayaquil'; }
    elseif ($args['timezone'] == 'guyana') { $output .= '&ctz=America/Guyana'; }
    elseif ($args['timezone'] == 'atlantictime-halifax') { $output .= '&ctz=America/Halifax'; }
    elseif ($args['timezone'] == 'havana') { $output .= '&ctz=America/Havana'; }
    elseif ($args['timezone'] == 'mountaintime-hermosillo') { $output .= '&ctz=America/Hermosillo'; }
    elseif ($args['timezone'] == 'easterntime-iqaluit') { $output .= '&ctz=America/Iqaluit'; }
    elseif ($args['timezone'] == 'jamaica') { $output .= '&ctz=America/Jamaica'; }
    elseif ($args['timezone'] == 'lapaz') { $output .= '&ctz=America/La_Paz'; }
    elseif ($args['timezone'] == 'lima') { $output .= '&ctz=America/Lima'; }
    elseif ($args['timezone'] == 'pacifictime') { $output .= '&ctz=America/Los_Angeles'; }
    elseif ($args['timezone'] == 'maceio') { $output .= '&ctz=America/Maceio'; }
    elseif ($args['timezone'] == 'managua') { $output .= '&ctz=America/Managua'; }
    elseif ($args['timezone'] == 'manaus') { $output .= '&ctz=America/Manaus'; }
    elseif ($args['timezone'] == 'martinique') { $output .= '&ctz=America/Martinique'; }
    elseif ($args['timezone'] == 'mountaintime-chihuahua,mazatlan') { $output .= '&ctz=America/Mazatlan'; }
    elseif ($args['timezone'] == 'centraltime-mexicocity') { $output .= '&ctz=America/Mexico_City'; }
    elseif ($args['timezone'] == 'miquelon') { $output .= '&ctz=America/Miquelon'; }
    elseif ($args['timezone'] == 'montevideo') { $output .= '&ctz=America/Montevideo'; }
    elseif ($args['timezone'] == 'easterntime-montreal') { $output .= '&ctz=America/Montreal'; }
    elseif ($args['timezone'] == 'montserrat') { $output .= '&ctz=America/Montserrat'; }
    elseif ($args['timezone'] == 'nassau') { $output .= '&ctz=America/Nassau'; }
    elseif ($args['timezone'] == 'easterntime') { $output .= '&ctz=America/New_York'; }
    elseif ($args['timezone'] == 'noronha') { $output .= '&ctz=America/Noronha'; }
    elseif ($args['timezone'] == 'panama') { $output .= '&ctz=America/Panama'; }
    elseif ($args['timezone'] == 'paramaribo') { $output .= '&ctz=America/Paramaribo'; }
    elseif ($args['timezone'] == 'mountaintime-arizona') { $output .= '&ctz=America/Phoenix'; }
    elseif ($args['timezone'] == 'portofspain') { $output .= '&ctz=America/Port_of_Spain'; }
    elseif ($args['timezone'] == 'port-au-prince') { $output .= '&ctz=America/Port-au-Prince'; }
    elseif ($args['timezone'] == 'portovelho') { $output .= '&ctz=America/Porto_Velho'; }
    elseif ($args['timezone'] == 'puertorico') { $output .= '&ctz=America/Puerto_Rico'; }
    elseif ($args['timezone'] == 'recife') { $output .= '&ctz=America/Recife'; }
    elseif ($args['timezone'] == 'centraltime-regina') { $output .= '&ctz=America/Regina'; }
    elseif ($args['timezone'] == 'riobranco') { $output .= '&ctz=America/Rio_Branco'; }
    elseif ($args['timezone'] == 'santiago') { $output .= '&ctz=America/Santiago'; }
    elseif ($args['timezone'] == 'santodomingo') { $output .= '&ctz=America/Santo_Domingo'; }
    elseif ($args['timezone'] == 'saopaulo') { $output .= '&ctz=America/Sao_Paulo'; }
    elseif ($args['timezone'] == 'scoresbysund') { $output .= '&ctz=America/Scoresbysund'; }
    elseif ($args['timezone'] == 'newfoundlandtime-st.johns') { $output .= '&ctz=America/St_Johns'; }
    elseif ($args['timezone'] == 'st.kitts') { $output .= '&ctz=America/St_Kitts'; }
    elseif ($args['timezone'] == 'st.lucia') { $output .= '&ctz=America/St_Lucia'; }
    elseif ($args['timezone'] == 'st.thomas') { $output .= '&ctz=America/St_Thomas'; }
    elseif ($args['timezone'] == 'st.vincent') { $output .= '&ctz=America/St_Vincent'; }
    elseif ($args['timezone'] == 'centraltime-tegucigalpa') { $output .= '&ctz=America/Tegucigalpa'; }
    elseif ($args['timezone'] == 'thule') { $output .= '&ctz=America/Thule'; }
    elseif ($args['timezone'] == 'pacifictime-tijuana') { $output .= '&ctz=America/Tijuana'; }
    elseif ($args['timezone'] == 'easterntime-toronto') { $output .= '&ctz=America/Toronto'; }
    elseif ($args['timezone'] == 'tortola') { $output .= '&ctz=America/Tortola'; }
    elseif ($args['timezone'] == 'pacifictime-vancouver') { $output .= '&ctz=America/Vancouver'; }
    elseif ($args['timezone'] == 'pacifictime-whitehorse') { $output .= '&ctz=America/Whitehorse'; }
    elseif ($args['timezone'] == 'centraltime-winnipeg') { $output .= '&ctz=America/Winnipeg'; }
    elseif ($args['timezone'] == 'mountaintime-yellowknife') { $output .= '&ctz=America/Yellowknife'; }
    elseif ($args['timezone'] == 'casey') { $output .= '&ctz=Antarctica/Casey'; }
    elseif ($args['timezone'] == 'davis') { $output .= '&ctz=Antarctica/Davis'; }
    elseif ($args['timezone'] == 'dumontdurville') { $output .= '&ctz=Antarctica/DumontDUrville'; }
    elseif ($args['timezone'] == 'mawson') { $output .= '&ctz=Antarctica/Mawson'; }
    elseif ($args['timezone'] == 'mcmurdo') { $output .= '&ctz=Antarctica/McMurdo'; }
    elseif ($args['timezone'] == 'palmer') { $output .= '&ctz=Antarctica/Palmer'; }
    elseif ($args['timezone'] == 'rothera') { $output .= '&ctz=Antarctica/Rothera'; }
    elseif ($args['timezone'] == 'southpole') { $output .= '&ctz=Antarctica/South_Pole'; }
    elseif ($args['timezone'] == 'syowa') { $output .= '&ctz=Antarctica/Syowa'; }
    elseif ($args['timezone'] == 'vostok') { $output .= '&ctz=Antarctica/Vostok'; }
    elseif ($args['timezone'] == 'aden') { $output .= '&ctz=Asia/Aden'; }
    elseif ($args['timezone'] == 'almaty') { $output .= '&ctz=Asia/Almaty'; }
    elseif ($args['timezone'] == 'amman') { $output .= '&ctz=Asia/Amman'; }
    elseif ($args['timezone'] == 'aqtau') { $output .= '&ctz=Asia/Aqtau'; }
    elseif ($args['timezone'] == 'aqtobe') { $output .= '&ctz=Asia/Aqtobe'; }
    elseif ($args['timezone'] == 'ashgabat') { $output .= '&ctz=Asia/Ashgabat'; }
    elseif ($args['timezone'] == 'baghdad') { $output .= '&ctz=Asia/Baghdad'; }
    elseif ($args['timezone'] == 'bahrain') { $output .= '&ctz=Asia/Bahrain'; }
    elseif ($args['timezone'] == 'baku') { $output .= '&ctz=Asia/Baku'; }
    elseif ($args['timezone'] == 'bangkok') { $output .= '&ctz=Asia/Bangkok'; }
    elseif ($args['timezone'] == 'beirut') { $output .= '&ctz=Asia/Beirut'; }
    elseif ($args['timezone'] == 'bishkek') { $output .= '&ctz=Asia/Bishkek'; }
    elseif ($args['timezone'] == 'brunei') { $output .= '&ctz=Asia/Brunei'; }
    elseif ($args['timezone'] == 'indiastandardtime') { $output .= '&ctz=Asia/Calcutta'; }
    elseif ($args['timezone'] == 'choibalsan') { $output .= '&ctz=Asia/Choibalsan'; }
    elseif ($args['timezone'] == 'colombo') { $output .= '&ctz=Asia/Colombo'; }
    elseif ($args['timezone'] == 'damascus') { $output .= '&ctz=Asia/Damascus'; }
    elseif ($args['timezone'] == 'dhaka') { $output .= '&ctz=Asia/Dhaka'; }
    elseif ($args['timezone'] == 'dili') { $output .= '&ctz=Asia/Dili'; }
    elseif ($args['timezone'] == 'dubai') { $output .= '&ctz=Asia/Dubai'; }
    elseif ($args['timezone'] == 'dushanbe') { $output .= '&ctz=Asia/Dushanbe'; }
    elseif ($args['timezone'] == 'gaza') { $output .= '&ctz=Asia/Gaza'; }
    elseif ($args['timezone'] == 'hongkong') { $output .= '&ctz=Asia/Hong_Kong'; }
    elseif ($args['timezone'] == 'hovd') { $output .= '&ctz=Asia/Hovd'; }
    elseif ($args['timezone'] == 'moscow+05-irkutsk') { $output .= '&ctz=Asia/Irkutsk'; }
    elseif ($args['timezone'] == 'jakarta') { $output .= '&ctz=Asia/Jakarta'; }
    elseif ($args['timezone'] == 'jayapura') { $output .= '&ctz=Asia/Jayapura'; }
    elseif ($args['timezone'] == 'jerusalem') { $output .= '&ctz=Asia/Jerusalem'; }
    elseif ($args['timezone'] == 'kabul') { $output .= '&ctz=Asia/Kabul'; }
    elseif ($args['timezone'] == 'moscow+08-petropavlovsk-kamchatskiy') { $output .= '&ctz=Asia/Kamchatka'; }
    elseif ($args['timezone'] == 'karachi') { $output .= '&ctz=Asia/Karachi'; }
    elseif ($args['timezone'] == 'katmandu') { $output .= '&ctz=Asia/Katmandu'; }
    elseif ($args['timezone'] == 'moscow+04-krasnoyarsk') { $output .= '&ctz=Asia/Krasnoyarsk'; }
    elseif ($args['timezone'] == 'kualalumpur') { $output .= '&ctz=Asia/Kuala_Lumpur'; }
    elseif ($args['timezone'] == 'kuwait') { $output .= '&ctz=Asia/Kuwait'; }
    elseif ($args['timezone'] == 'macau') { $output .= '&ctz=Asia/Macau'; }
    elseif ($args['timezone'] == 'moscow+08-magadan') { $output .= '&ctz=Asia/Magadan'; }
    elseif ($args['timezone'] == 'makassar') { $output .= '&ctz=Asia/Makassar'; }
    elseif ($args['timezone'] == 'manila') { $output .= '&ctz=Asia/Manila'; }
    elseif ($args['timezone'] == 'muscat') { $output .= '&ctz=Asia/Muscat'; }
    elseif ($args['timezone'] == 'nicosia') { $output .= '&ctz=Asia/Nicosia'; }
    elseif ($args['timezone'] == 'moscow+03-omsk,novosibirsk') { $output .= '&ctz=Asia/Omsk'; }
    elseif ($args['timezone'] == 'phnompenh') { $output .= '&ctz=Asia/Phnom_Penh'; }
    elseif ($args['timezone'] == 'pyongyang') { $output .= '&ctz=Asia/Pyongyang'; }
    elseif ($args['timezone'] == 'qatar') { $output .= '&ctz=Asia/Qatar'; }
    elseif ($args['timezone'] == 'rangoon') { $output .= '&ctz=Asia/Rangoon'; }
    elseif ($args['timezone'] == 'riyadh') { $output .= '&ctz=Asia/Riyadh'; }
    elseif ($args['timezone'] == 'hanoi') { $output .= '&ctz=Asia/Saigon'; }
    elseif ($args['timezone'] == 'seoul') { $output .= '&ctz=Asia/Seoul'; }
    elseif ($args['timezone'] == 'chinatime-beijing') { $output .= '&ctz=Asia/Shanghai'; }
    elseif ($args['timezone'] == 'singapore') { $output .= '&ctz=Asia/Singapore'; }
    elseif ($args['timezone'] == 'taipei') { $output .= '&ctz=Asia/Taipei'; }
    elseif ($args['timezone'] == 'tashkent') { $output .= '&ctz=Asia/Tashkent'; }
    elseif ($args['timezone'] == 'tbilisi') { $output .= '&ctz=Asia/Tbilisi'; }
    elseif ($args['timezone'] == 'tehran') { $output .= '&ctz=Asia/Tehran'; }
    elseif ($args['timezone'] == 'thimphu') { $output .= '&ctz=Asia/Thimphu'; }
    elseif ($args['timezone'] == 'tokyo') { $output .= '&ctz=Asia/Tokyo'; }
    elseif ($args['timezone'] == 'ulaanbaatar') { $output .= '&ctz=Asia/Ulaanbaatar'; }
    elseif ($args['timezone'] == 'vientiane') { $output .= '&ctz=Asia/Vientiane'; }
    elseif ($args['timezone'] == 'moscow+07-yuzhno-sakhalinsk') { $output .= '&ctz=Asia/Vladivostok'; }
    elseif ($args['timezone'] == 'moscow+06-yakutsk') { $output .= '&ctz=Asia/Yakutsk'; }
    elseif ($args['timezone'] == 'moscow+02-yekaterinburg') { $output .= '&ctz=Asia/Yekaterinburg'; }
    elseif ($args['timezone'] == 'yerevan') { $output .= '&ctz=Asia/Yerevan'; }
    elseif ($args['timezone'] == 'azores') { $output .= '&ctz=Atlantic/Azores'; }
    elseif ($args['timezone'] == 'bermuda') { $output .= '&ctz=Atlantic/Bermuda'; }
    elseif ($args['timezone'] == 'canaryislands') { $output .= '&ctz=Atlantic/Canary'; }
    elseif ($args['timezone'] == 'capeverde') { $output .= '&ctz=Atlantic/Cape_Verde'; }
    elseif ($args['timezone'] == 'faeroe') { $output .= '&ctz=Atlantic/Faeroe'; }
    elseif ($args['timezone'] == 'reykjavik') { $output .= '&ctz=Atlantic/Reykjavik'; }
    elseif ($args['timezone'] == 'southgeorgia') { $output .= '&ctz=Atlantic/South_Georgia'; }
    elseif ($args['timezone'] == 'sthelena') { $output .= '&ctz=Atlantic/St_Helena'; }
    elseif ($args['timezone'] == 'stanley') { $output .= '&ctz=Atlantic/Stanley'; }
    elseif ($args['timezone'] == 'centraltime-adelaide') { $output .= '&ctz=Australia/Adelaide'; }
    elseif ($args['timezone'] == 'easterntime-brisbane') { $output .= '&ctz=Australia/Brisbane'; }
    elseif ($args['timezone'] == 'centraltime-darwin') { $output .= '&ctz=Australia/Darwin'; }
    elseif ($args['timezone'] == 'easterntime-hobart') { $output .= '&ctz=Australia/Hobart'; }
    elseif ($args['timezone'] == 'westerntime-perth') { $output .= '&ctz=Australia/Perth'; }
    elseif ($args['timezone'] == 'easterntime-melbourne,sydney') { $output .= '&ctz=Australia/Sydney'; }
    elseif ($args['timezone'] == 'amsterdam') { $output .= '&ctz=Europe/Amsterdam'; }
    elseif ($args['timezone'] == 'andorra') { $output .= '&ctz=Europe/Andorra'; }
    elseif ($args['timezone'] == 'athens') { $output .= '&ctz=Europe/Athens'; }
    elseif ($args['timezone'] == 'centraleuropeantime-belgrade') { $output .= '&ctz=Europe/Belgrade'; }
    elseif ($args['timezone'] == 'berlin') { $output .= '&ctz=Europe/Berlin'; }
    elseif ($args['timezone'] == 'brussels') { $output .= '&ctz=Europe/Brussels'; }
    elseif ($args['timezone'] == 'bucharest') { $output .= '&ctz=Europe/Bucharest'; }
    elseif ($args['timezone'] == 'budapest') { $output .= '&ctz=Europe/Budapest'; }
    elseif ($args['timezone'] == 'chisinau') { $output .= '&ctz=Europe/Chisinau'; }
    elseif ($args['timezone'] == 'copenhagen') { $output .= '&ctz=Europe/Copenhagen'; }
    elseif ($args['timezone'] == 'dublin') { $output .= '&ctz=Europe/Dublin'; }
    elseif ($args['timezone'] == 'gibraltar') { $output .= '&ctz=Europe/Gibraltar'; }
    elseif ($args['timezone'] == 'helsinki') { $output .= '&ctz=Europe/Helsinki'; }
    elseif ($args['timezone'] == 'istanbul') { $output .= '&ctz=Europe/Istanbul'; }
    elseif ($args['timezone'] == 'moscow-01-kaliningrad') { $output .= '&ctz=Europe/Kaliningrad'; }
    elseif ($args['timezone'] == 'kiev') { $output .= '&ctz=Europe/Kiev'; }
    elseif ($args['timezone'] == 'lisbon') { $output .= '&ctz=Europe/Lisbon'; }
    elseif ($args['timezone'] == 'london') { $output .= '&ctz=Europe/London'; }
    elseif ($args['timezone'] == 'luxembourg') { $output .= '&ctz=Europe/Luxembourg'; }
    elseif ($args['timezone'] == 'madrid') { $output .= '&ctz=Europe/Madrid'; }
    elseif ($args['timezone'] == 'malta') { $output .= '&ctz=Europe/Malta'; }
    elseif ($args['timezone'] == 'minsk') { $output .= '&ctz=Europe/Minsk'; }
    elseif ($args['timezone'] == 'monaco') { $output .= '&ctz=Europe/Monaco'; }
    elseif ($args['timezone'] == 'moscow+00') { $output .= '&ctz=Europe/Moscow'; }
    elseif ($args['timezone'] == 'oslo') { $output .= '&ctz=Europe/Oslo'; }
    elseif ($args['timezone'] == 'paris') { $output .= '&ctz=Europe/Paris'; }
    elseif ($args['timezone'] == 'centraleuropeantime-prague') { $output .= '&ctz=Europe/Prague'; }
    elseif ($args['timezone'] == 'riga') { $output .= '&ctz=Europe/Riga'; }
    elseif ($args['timezone'] == 'rome') { $output .= '&ctz=Europe/Rome'; }
    elseif ($args['timezone'] == 'moscow+00-samara') { $output .= '&ctz=Europe/Samara'; }
    elseif ($args['timezone'] == 'sofia') { $output .= '&ctz=Europe/Sofia'; }
    elseif ($args['timezone'] == 'stockholm') { $output .= '&ctz=Europe/Stockholm'; }
    elseif ($args['timezone'] == 'tallinn') { $output .= '&ctz=Europe/Tallinn'; }
    elseif ($args['timezone'] == 'tirane') { $output .= '&ctz=Europe/Tirane'; }
    elseif ($args['timezone'] == 'vaduz') { $output .= '&ctz=Europe/Uzhgorod'; }
    elseif ($args['timezone'] == 'vienna') { $output .= '&ctz=Europe/Vienna'; }
    elseif ($args['timezone'] == 'vilnius') { $output .= '&ctz=Europe/Vilnius'; }
    elseif ($args['timezone'] == 'warsaw') { $output .= '&ctz=Europe/Warsaw'; }
    elseif ($args['timezone'] == 'zurich') { $output .= '&ctz=Europe/Zurich'; }
    elseif ($args['timezone'] == 'GMT') { $output .= '&ctz=Etc/GMT'; }
    elseif ($args['timezone'] == 'antananarivo') { $output .= '&ctz=Indian/Antananarivo'; }
    elseif ($args['timezone'] == 'chagos') { $output .= '&ctz=Indian/Chagos'; }
    elseif ($args['timezone'] == 'christmas') { $output .= '&ctz=Indian/Christmas'; }
    elseif ($args['timezone'] == 'cocos') { $output .= '&ctz=Indian/Cocos'; }
    elseif ($args['timezone'] == 'comoro') { $output .= '&ctz=Indian/Comoro'; }
    elseif ($args['timezone'] == 'kerguelen') { $output .= '&ctz=Indian/Kerguelen'; }
    elseif ($args['timezone'] == 'mahe') { $output .= '&ctz=Indian/Mahe'; }
    elseif ($args['timezone'] == 'maldives') { $output .= '&ctz=Indian/Maldives'; }
    elseif ($args['timezone'] == 'mauritius') { $output .= '&ctz=Indian/Mauritius'; }
    elseif ($args['timezone'] == 'mayotte') { $output .= '&ctz=Indian/Mayotte'; }
    elseif ($args['timezone'] == 'reunion') { $output .= '&ctz=Indian/Reunion'; }
    elseif ($args['timezone'] == 'apia') { $output .= '&ctz=Pacific/Apia'; }
    elseif ($args['timezone'] == 'auckland') { $output .= '&ctz=Pacific/Auckland'; }
    elseif ($args['timezone'] == 'easterisland') { $output .= '&ctz=Pacific/Easter'; }
    elseif ($args['timezone'] == 'efate') { $output .= '&ctz=Pacific/Efate'; }
    elseif ($args['timezone'] == 'enderbury') { $output .= '&ctz=Pacific/Enderbury'; }
    elseif ($args['timezone'] == 'fakaofo') { $output .= '&ctz=Pacific/Fakaofo'; }
    elseif ($args['timezone'] == 'fiji') { $output .= '&ctz=Pacific/Fiji'; }
    elseif ($args['timezone'] == 'funafuti') { $output .= '&ctz=Pacific/Funafuti'; }
    elseif ($args['timezone'] == 'galapagos') { $output .= '&ctz=Pacific/Galapagos'; }
    elseif ($args['timezone'] == 'gambier') { $output .= '&ctz=Pacific/Gambier'; }
    elseif ($args['timezone'] == 'guadalcanal') { $output .= '&ctz=Pacific/Guadalcanal'; }
    elseif ($args['timezone'] == 'guam') { $output .= '&ctz=Pacific/Guam'; }
    elseif ($args['timezone'] == 'hawaiitime') { $output .= '&ctz=Pacific/Honolulu'; }
    elseif ($args['timezone'] == 'johnston') { $output .= '&ctz=Pacific/Johnston'; }
    elseif ($args['timezone'] == 'kiritimati') { $output .= '&ctz=Pacific/Kiritimati'; }
    elseif ($args['timezone'] == 'kosrae') { $output .= '&ctz=Pacific/Kosrae'; }
    elseif ($args['timezone'] == 'kwajalein') { $output .= '&ctz=Pacific/Kwajalein'; }
    elseif ($args['timezone'] == 'majuro') { $output .= '&ctz=Pacific/Majuro'; }
    elseif ($args['timezone'] == 'marquesas') { $output .= '&ctz=Pacific/Marquesas'; }
    elseif ($args['timezone'] == 'midway') { $output .= '&ctz=Pacific/Midway'; }
    elseif ($args['timezone'] == 'nauru') { $output .= '&ctz=Pacific/Nauru'; }
    elseif ($args['timezone'] == 'niue') { $output .= '&ctz=Pacific/Niue'; }
    elseif ($args['timezone'] == 'norfolk') { $output .= '&ctz=Pacific/Norfolk'; }
    elseif ($args['timezone'] == 'noumea') { $output .= '&ctz=Pacific/Noumea'; }
    elseif ($args['timezone'] == 'pagopago') { $output .= '&ctz=Pacific/Pago_Pago'; }
    elseif ($args['timezone'] == 'palau') { $output .= '&ctz=Pacific/Palau'; }
    elseif ($args['timezone'] == 'pitcairn') { $output .= '&ctz=Pacific/Pitcairn'; }
    elseif ($args['timezone'] == 'ponape') { $output .= '&ctz=Pacific/Ponape'; }
    elseif ($args['timezone'] == 'portmoresby') { $output .= '&ctz=Pacific/Port_Moresby'; }
    elseif ($args['timezone'] == 'rarotonga') { $output .= '&ctz=Pacific/Rarotonga'; }
    elseif ($args['timezone'] == 'saipan') { $output .= '&ctz=Pacific/Saipan'; }
    elseif ($args['timezone'] == 'tahiti') { $output .= '&ctz=Pacific/Tahiti'; }
    elseif ($args['timezone'] == 'tarawa') { $output .= '&ctz=Pacific/Tarawa'; }
    elseif ($args['timezone'] == 'tongatapu') { $output .= '&ctz=Pacific/Tongatapu'; }
    elseif ($args['timezone'] == 'truk') { $output .= '&ctz=Pacific/Truk'; }
    elseif ($args['timezone'] == 'wake') { $output .= '&ctz=Pacific/Wake'; }
    elseif ($args['timezone'] == 'wallis') { $output .= '&ctz=Pacific/Wallis'; }
    else { } # Show the user's default time zone


  if ($args['date'] == 'off') { $output .= '&showDate=0'; } # private version only

  if ($args['print'] == 'off') { $output .= '&showPrint=0'; } # private version only

  if ($args['tabs'] == 'off') { $output .= '&showTabs=0'; } # private version only

  if ($args['showcals'] == 'off') { $output .= '&showCalendars=0'; } # private version only

  if ($args['showTz'] == 'off') { $output .= '&showTz=0'; } # private version only


  # OTHER CALENDARS
#  $output .= '&src=%23contacts%40group.v.calendar.google.com';         # Contacts' Birthdays
#  $output .= '&src=es-419.cl%23holiday%40group.v.calendar.google.com'; # Feriados chile
#  $output .= '&src=en.cl%23holiday%40group.v.calendar.google.com';     # Holidays in chile

  for ($i=0; $i<=100;$i++) {
   if ($args['calendar' . "$i"])  # calendar0, calendar1, calendar2, ...
    $output .= '&src=' . str_replace(array("@","#"),array("%40","%23"),$args['calendar' . $i]); }
  # <-------------------------------------------------------------------> #

  $output .= '"';  # Close quotes for src="..."

  if ($args['border'] == 'off') { $output .= ' style="border-width:0"'; }
    else { $output .= ' style="border:solid 1px #777"'; }

  $output .= ' width=' . $args['width'];
  $output .= ' height=' . $args['height'];
  $output .= ' frameborder="0" scrolling="no"';
  $output .= '>'; 

  $output .= '</iframe>';

 } // end valid calendar

return Keep($output);
 }

function strip_quotes($string) {
  $string = stripslashes($string);
  $string = str_replace("'", "", $string);
  $string = str_replace('"', '', $string);
  return $string;
  }

?>
