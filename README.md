`lineageos_stats.php` is a command-line script to download LineageOS stats
about the number of builds and installs from https://stats.lineageos.org  
It displays more information than is provided by the LineageOS web page,
which only displays builds by their code name and countries by their ISO
codes. This script can search for countries by their English names and 
for builds by their device model names. It tallies the total builds and 
installs by country, device manufacturer, processor family, release year
of devices, build status and LineageOS version number.   
  
By default the script shows the country list and the build list with 
statistics tables at the end. If information is known about a build 
(device model, manufacturer, processor family, device release year), 
that is displayed in the build list. There is normally 1 build per 
device model, but some builds support multiple device models.

Getting the country list is fast, but getting the build list is
very slow because the script has to download roughly 1500 web pages to
get all the builds for each country to construct the build list, and 
there are some less popular builds that it won't find because LineageOS 
only provides the top 250 builds for each country. LineageOS doesn't 
provide a complete list of builds, but it does provide a total installs 
number, so any installs that aren't found are tallied at the end of the 
list under "Unlisted". 

The status codes for the builds are:  
**O** = active official build,  
**D** = discontinued official build,  
**U** = unofficial build  
Note that many of the installs labeled as "O" are for versions that are
now discontinued, since they are no longer getting security updates.  
 
**Installation:**   
1. Install the command line interface for PHP 7 or later. ´
2. Install the php-mbstring extension.
3. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work: 
```
sudo apt install php php-mbstring
wget -O lineageos_stats.zip https://github.com/amosbatto/lineageos_stats/archive/refs/heads/main.zip
unzip lineageos_stats.zip -d lineageos_stats
```
  
**Execution:**  
To run the script in a terminal:  
`php lineageos_stats.php`
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:  
`C:\users\bob\php8.3\php.exe lineageos_stats.php` 

**Command line options:**  
```
-c , --country   Display the country list.   
                 Ex: php lineageos_stats.php -c  
                   
-cXX             Can specify an optional two letter country code or a
--country=XX     country name to display stats for a single country.  
                 Ex: php lineageos_stats.php -cUS  
                 Ex: php lineageos_stats.php --country=BR  
                 Ex: php lineageos_stats.php -c"United Arab Emirates"  
                   
-b , --build     Display the build list.  
                 Ex: php lineageos_stats.php -b  
                   
-bCODENAME       Can specify a build codename or a device model name to  
--build=CODENAME display stats for a single build.  
                 Ex: php lineageos_stats.php -blavender  
                 Ex: php lineageos_stats.php --build=lavender  
                 Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"  
                 Ex: php lineageos_stats.php --build="nOtE 7"  
                 The search is case insensitive and can find partial   
                 strings.
                                                                        
-sSEP             The field separator for tables, which can be any 
--separator=SEP   string and is " | " by default. It is recommended to 
                  set to "\t" (tab) if copying into a spreadsheet and
                  to ',' (comma) or ';' (semicolon) if copying into a
                  a CSV (comma separated value) file.
                  Ex: php lineageos_stats.php -s"\t"                   
                  Ex: php lineageos_stats.php -separator="; "                             
                  
-v , --verbose   Show information about what countries are being  
                 downloaded and what builds were found. Recommended 
                 for progress on how script is progressing when 
                 getting the build list.  
```

**Author:**  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)  
**License:** MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom https://sourceforge.net/projects/simplehtmldom)  
**Last update:**    2025-10-28 (version 0.3)  

----------------

For people who don't what to install and run this script on their own
computers, here is the output of the script on October 30, 2025:

```
$ php lineageos_stats.php
Countries by number of LineageOS installs
---------------------------------------------------------------------------------------------
| Rank |   CC    |        Country         | Installs | % Installs | Installs/M | Pop. (000) |
---------------------------------------------------------------------------------------------
| 1    | BR      | Brazil                 |  1889268 |     43.95% |       8878 |  212812.41 |
| 2    | CN      | China                  |  1226975 |     28.54% |        866 | 1416096.09 |
| 3    | US      | United States          |   306909 |      7.14% |        884 |  347275.81 |
| 4    | Unknown |                        |   299650 |      6.97% |            |            |
| 5    | VN      | Viet Nam               |    96916 |      2.25% |        954 |  101598.53 |
| 6    | DE      | Germany                |    43083 |      1.00% |        512 |   84075.08 |
| 7    | ID      | Indonesia              |    40290 |      0.94% |        141 |  285721.24 |
| 8    | RU      | Russian Federation     |    33131 |      0.77% |        230 |  143997.39 |
| 9    | UA      | Ukraine                |    31328 |      0.73% |        804 |   38980.38 |
| 10   | IN      | India                  |    26106 |      0.61% |         18 | 1463865.53 |
| 11   | KR      | South Korea            |    24605 |      0.57% |        476 |   51667.03 |
| 12   | FR      | France                 |    19474 |      0.45% |        292 |   66650.80 |
| 13   | GB      | United Kingdom         |    14172 |      0.33% |        204 |   69551.33 |
| 14   | ES      | Spain                  |    12903 |      0.30% |        269 |   47889.96 |
| 15   | IT      | Italy                  |    12528 |      0.29% |        212 |   59146.26 |
| 16   | TR      | Turkey                 |    11306 |      0.26% |        129 |   87685.43 |
| 17   | PL      | Poland                 |    10949 |      0.25% |        287 |   38140.91 |
| 18   | EG      | Egypt                  |    10897 |      0.25% |         92 |  118366.00 |
| 19   | TH      | Thailand               |    10480 |      0.24% |        146 |   71619.86 |
| 20   | KG      | Kyrgyzstan             |     8869 |      0.21% |       1216 |    7295.03 |
| 21   | KH      | Cambodia               |     8716 |      0.20% |        488 |   17847.98 |
| 22   | JP      | Japan                  |     8148 |      0.19% |         66 |  123103.48 |
| 23   | MX      | Mexico                 |     7730 |      0.18% |         59 |  131946.90 |
| 24   | NL      | Netherlands            |     6870 |      0.16% |        374 |   18346.82 |
| 25   | CA      | Canada                 |     6792 |      0.16% |        169 |   40126.72 |
| 26   | IQ      | Iraq                   |     4889 |      0.11% |        104 |   47020.77 |
| 27   | BD      | Bangladesh             |     4794 |      0.11% |         27 |  175686.90 |
| 28   | IR      | Iran                   |     4464 |      0.10% |         48 |   92417.68 |
| 29   | AR      | Argentina              |     4357 |      0.10% |         95 |   45851.38 |
| 30   | PK      | Pakistan               |     3935 |      0.09% |         15 |  255219.55 |
| 31   | TW      | Taiwan                 |     3739 |      0.09% |        162 |   23112.79 |
| 32   | PH      | Philippines            |     3638 |      0.08% |         31 |  116786.96 |
| 33   | CO      | Colombia               |     3357 |      0.08% |         63 |   53425.64 |
| 34   | MA      | Morocco                |     3322 |      0.08% |         86 |   38430.77 |
| 35   | AU      | Australia              |     3056 |      0.07% |        113 |   26974.03 |
| 36   | MY      | Malaysia               |     2931 |      0.07% |         81 |   35977.84 |
| 37   | DZ      | Algeria                |     2840 |      0.07% |         60 |   47435.31 |
| 38   | CZ      | Czech Republic         |     2707 |      0.06% |        255 |   10609.24 |
| 39   | AT      | Austria                |     2703 |      0.06% |        297 |    9113.57 |
| 40   | RO      | Romania                |     2697 |      0.06% |        143 |   18908.65 |
| 41   | PT      | Portugal               |     2685 |      0.06% |        258 |   10411.83 |
| 42   | SY      | Syrian Arab Republic   |     2411 |      0.06% |         94 |   25620.43 |
| 43   | CH      | Switzerland            |     2395 |      0.06% |        267 |    8967.41 |
| 44   | SE      | Sweden                 |     2339 |      0.05% |        219 |   10656.63 |
| 45   | LA      | Laos                   |     2246 |      0.05% |        285 |    7873.05 |
| 46   | HU      | Hungary                |     2224 |      0.05% |        231 |    9632.29 |
| 47   | NG      | Nigeria                |     2194 |      0.05% |          9 |  237527.78 |
| 48   | BY      | Belarus                |     2162 |      0.05% |        240 |    8997.60 |
| 49   | PE      | Peru                   |     1961 |      0.05% |         57 |   34576.67 |
| 50   | BE      | Belgium                |     1915 |      0.04% |        163 |   11758.60 |
| 51   | CL      | Chile                  |     1820 |      0.04% |         92 |   19859.92 |
| 52   | FI      | Finland                |     1805 |      0.04% |        321 |    5623.33 |
| 53   | GR      | Greece                 |     1796 |      0.04% |        181 |    9938.84 |
| 54   | AE      | United Arab Emirates   |     1792 |      0.04% |        158 |   11346.00 |
| 55   | HK      | Hong Kong              |     1693 |      0.04% |        229 |    7396.08 |
| 56   | GH      | Ghana                  |     1517 |      0.04% |         43 |   35064.27 |
| 57   | SA      | Saudi Arabia           |     1437 |      0.03% |         42 |   34566.33 |
| 58   | IL      | Israel                 |     1421 |      0.03% |        149 |    9517.18 |
| 59   | MM      | Myanmar                |     1379 |      0.03% |         25 |   54850.65 |
| 60   | VE      | Venezuela              |     1364 |      0.03% |         48 |   28516.90 |
| 61   | SK      | Slovakia               |     1257 |      0.03% |        230 |    5474.88 |
| 62   | OM      | Oman                   |     1248 |      0.03% |        227 |    5494.69 |
| 63   | KZ      | Kazakhstan             |     1245 |      0.03% |         60 |   20843.75 |
| 64   | ZA      | South Africa           |     1234 |      0.03% |         19 |   64747.32 |
| 65   | RS      | Serbia                 |     1209 |      0.03% |        181 |    6689.04 |
| 66   | BG      | Bulgaria               |     1202 |      0.03% |        179 |    6714.56 |
| 67   | EC      | Ecuador                |     1102 |      0.03% |         60 |   18289.90 |
| 68   | MG      | Madagascar             |     1075 |      0.03% |         33 |   32740.68 |
| 69   | BO      | Bolivia                |     1060 |      0.02% |         84 |   12581.84 |
| 70   | LK      | Sri Lanka              |     1014 |      0.02% |         44 |   23229.47 |
| 71   | KE      | Kenya                  |      999 |      0.02% |         17 |   57532.49 |
| 72   | NP      | Nepal                  |      972 |      0.02% |         33 |   29618.12 |
| 73   | NZ      | New Zealand            |      939 |      0.02% |        179 |    5251.90 |
| 74   | CM      | Cameroon               |      933 |      0.02% |         31 |   29879.34 |
| 75   | DK      | Denmark                |      923 |      0.02% |        154 |    6002.51 |
| 76   | NO      | Norway                 |      888 |      0.02% |        158 |    5623.07 |
| 77   | SV      | El Salvador            |      879 |      0.02% |        138 |    6365.50 |
| 78   | LT      | Lithuania              |      868 |      0.02% |        307 |    2830.14 |
| 79   | JO      | Jordan                 |      805 |      0.02% |         70 |   11520.68 |
| 80   | UZ      | Uzbekistan             |      787 |      0.02% |         21 |   37053.43 |
| 81   | SG      | Singapore              |      757 |      0.02% |        129 |    5870.75 |
| 82   | AZ      | Azerbaijan             |      727 |      0.02% |         70 |   10397.71 |
| 83   | IE      | Ireland                |      703 |      0.02% |        132 |    5308.04 |
| 84   | HR      | Croatia                |      672 |      0.02% |        175 |    3848.16 |
| 85   | BA      | Bosnia and Herzegovina |      652 |      0.02% |        208 |    3140.10 |
| 86   | MD      | Moldova                |      553 |      0.01% |        185 |    2996.11 |
| 87   | ET      | Ethiopia               |      534 |      0.01% |          4 |  135472.05 |
| 88   | DO      | Dominican Republic     |      530 |      0.01% |         46 |   11520.49 |
| 89   | ZM      | Zambia                 |      523 |      0.01% |         24 |   21913.87 |
| 90   | EE      | Estonia                |      491 |      0.01% |        365 |    1344.23 |
| 91   | TN      | Tunisia                |      470 |      0.01% |         38 |   12348.57 |
| 92   | SI      | Slovenia               |      466 |      0.01% |        220 |    2117.07 |
| 93   | ML      | Mali                   |      460 |      0.01% |         18 |   25198.82 |
| 94   | TG      | Togo                   |      446 |      0.01% |         46 |    9721.61 |
| 95   | GE      | Georgia                |      412 |     0.010% |        108 |    3806.67 |
| 96   | LV      | Latvia                 |      402 |     0.009% |        217 |    1853.56 |
| 97   | UG      | Uganda                 |      392 |     0.009% |          8 |   51384.89 |
| 98   | CI      | Côte d'Ivoire          |      370 |     0.009% |         11 |   32711.55 |
| 99   | PY      | Paraguay               |      364 |     0.008% |         52 |    7013.08 |
| 100  | UY      | Uruguay                |      343 |     0.008% |        101 |    3384.69 |
| 101  | CU      | Cuba                   |      334 |     0.008% |         31 |   10937.20 |
| 102  | YE      | Yemen                  |      333 |     0.008% |          8 |   41773.88 |
| 103  | SN      | Senegal                |      323 |     0.008% |         17 |   18931.97 |
| 104  | CR      | Costa Rica             |      317 |     0.007% |         62 |    5152.95 |
| 105  | AO      | Angola                 |      277 |     0.006% |          7 |   39040.04 |
| 106  | AM      | Armenia                |      270 |     0.006% |         91 |    2952.37 |
| 107  | GT      | Guatemala              |      255 |     0.006% |         14 |   18687.88 |
| 108  | BJ      | Benin                  |      240 |     0.006% |         16 |   14814.46 |
| 109  | CD      | Congo, Democratic Rep… |      229 |     0.005% |          2 |  112832.47 |
| 110  | AL      | Albania                |      210 |     0.005% |         76 |    2771.51 |
| 111  | HN      | Honduras               |      198 |     0.005% |         18 |   11005.85 |
| 112  | TZ      | Tanzania               |      193 |     0.004% |          3 |   70546.00 |
| 113  | LB      | Lebanon                |      192 |     0.004% |         33 |    5849.42 |
| 114  | JM      | Jamaica                |      179 |     0.004% |         63 |    2837.08 |
| 115  | MK      | Macedonia              |      177 |     0.004% |         98 |    1813.79 |
| 116  | PA      | Panama                 |      172 |     0.004% |         38 |    4571.19 |
| 117  | ZW      | Zimbabwe               |      168 |     0.004% |         10 |   16950.80 |
| 117  | AF      | Afghanistan            |      168 |     0.004% |          4 |   43844.11 |
| 119  | CY      | Cyprus                 |      164 |     0.004% |        120 |    1370.75 |
| 120  | QA      | Qatar                  |      161 |     0.004% |         52 |    3115.89 |
| 121  | BH      | Bahrain                |      158 |     0.004% |         96 |    1643.33 |
| 122  | NI      | Nicaragua              |      157 |     0.004% |         22 |    7007.50 |
| 123  | RE      | Réunion                |      150 |     0.003% |        170 |     882.41 |
| 123  | LY      | Libya                  |      150 |     0.003% |         20 |    7458.56 |
| 125  | LU      | Luxembourg             |      139 |     0.003% |        204 |     680.45 |
| 126  | MZ      | Mozambique             |      138 |     0.003% |          4 |   35631.65 |
| 127  | TJ      | Tajikistan             |      137 |     0.003% |         13 |   10786.73 |
| 128  | KW      | Kuwait                 |      130 |     0.003% |         26 |    5026.08 |
| 129  | MW      | Malawi                 |      127 |     0.003% |          6 |   22216.12 |
| 130  | GM      | Gambia                 |      115 |     0.003% |         41 |    2822.09 |
| 131  | SL      | Sierra Leone           |       92 |     0.002% |         10 |    8819.79 |
| 132  | MT      | Malta                  |       89 |     0.002% |        163 |     545.41 |
| 133  | TT      | Trinidad and Tobago    |       87 |     0.002% |         58 |    1511.16 |
| 134  | BF      | Burkina Faso           |       82 |     0.002% |          3 |   24074.58 |
| 135  | ME      | Montenegro             |       76 |     0.002% |        120 |     632.73 |
| 135  | IS      | Iceland                |       76 |     0.002% |        191 |     398.27 |
| 137  | MN      | Mongolia               |       74 |     0.002% |         21 |    3517.10 |
| 138  | MV      | Maldives               |       68 |     0.002% |        128 |     529.68 |
| 139  | SD      | Sudan                  |       67 |     0.002% |          1 |   51662.15 |
| 139  | MU      | Mauritius              |       67 |     0.002% |         53 |    1268.28 |
| 139  | CG      | Congo                  |       67 |     0.002% |         10 |    6484.44 |
| 142  | PG      | Papua New Guinea       |       62 |     0.001% |          6 |   10762.82 |
| 142  | GN      | Guinea                 |       62 |     0.001% |          4 |   15099.73 |
| 144  | SB      | Solomon Islands        |       59 |     0.001% |         70 |     838.65 |
| 145  | RW      | Rwanda                 |       58 |     0.001% |          4 |   14569.34 |
| 146  | TM      | Turkmenistan           |       57 |     0.001% |          7 |    7618.85 |
| 147  | MC      | Monaco                 |       50 |     0.001% |       1304 |      38.34 |
| 148  | BN      | Brunei Darussalam      |       49 |     0.001% |        105 |     466.33 |
| 149  | GP      | Guadeloupe             |       48 |     0.001% |        128 |     373.79 |
| 150  | HT      | Haiti                  |       46 |     0.001% |          4 |   11906.10 |
| 151  | MO      | Macao                  |       45 |     0.001% |         62 |     722.00 |
| 152  | NA      | Namibia                |       41 |    0.0010% |         13 |    3092.82 |
| 153  | ER      | Eritrea                |       39 |    0.0009% |         11 |    3607.00 |
| 154  | NE      | Niger                  |       34 |    0.0008% |          1 |   27917.83 |
| 155  | PR      | Puerto Rico            |       33 |    0.0008% |         10 |    3235.29 |
| 156  | GA      | Gabon                  |       29 |    0.0007% |         11 |    2593.13 |
| 157  | AD      | Andorra                |       27 |    0.0006% |        326 |      82.90 |
| 158  | LR      | Liberia                |       26 |    0.0006% |          5 |    5731.21 |
| 158  | BZ      | Belize                 |       26 |    0.0006% |         61 |     422.92 |
| 160  | SR      | Suriname               |       25 |    0.0006% |         39 |     639.85 |
| 160  | MR      | Mauritania             |       25 |    0.0006% |          5 |    5315.07 |
| 160  | CV      | Cape Verde             |       25 |    0.0006% |         47 |     527.33 |
| 160  | BW      | Botswana               |       25 |    0.0006% |         10 |    2562.12 |
| 164  | SO      | Somalia                |       24 |    0.0006% |          1 |   19654.74 |
| 164  | BI      | Burundi                |       24 |    0.0006% |          2 |   14390.00 |
| 166  | KP      | North Korea            |       23 |    0.0005% |        0.9 |   26571.00 |
| 167  | GY      | Guyana                 |       19 |    0.0004% |         23 |     835.99 |
| 168  | XK      | Kosovo                 |       16 |    0.0004% |         10 |    1674.13 |
| 169  | TD      | Chad                   |       15 |    0.0003% |        0.7 |   21003.71 |
| 169  | KM      | Comoros                |       15 |    0.0003% |         17 |     882.85 |
| 171  | LI      | Liechtenstein          |       14 |    0.0003% |        349 |      40.13 |
| 171  | FJ      | Fiji                   |       14 |    0.0003% |         15 |     933.15 |
| 173  | GW      | Guinea-Bissau          |       13 |    0.0003% |          6 |    2249.52 |
| 173  | CW      | Curaçao                |       13 |    0.0003% |         70 |     185.49 |
| 175  | NC      | New Caledonia          |       12 |    0.0003% |         41 |     295.33 |
| 176  | PF      | French Polynesia       |       11 |    0.0003% |         39 |     282.47 |
| 177  | VA      | Vatican City           |        9 |    0.0002% |      18000 |       0.50 |
| 177  | BB      | Barbados               |        9 |    0.0002% |         32 |     282.62 |
| 179  | FO      | Faroe Islands          |        8 |    0.0002% |        143 |      56.00 |
| 179  | DJ      | Djibouti               |        8 |    0.0002% |          7 |    1184.08 |
| 181  | CF      | Central African Repub… |        7 |    0.0002% |          1 |    5513.28 |
| 181  | BT      | Bhutan                 |        7 |    0.0002% |          9 |     796.68 |
| 183  | SC      | Seychelles             |        6 |    0.0001% |         45 |     132.78 |
| 183  | GL      | Greenland              |        6 |    0.0001% |        108 |      55.75 |
| 183  | BS      | Bahamas                |        6 |    0.0001% |         15 |     403.03 |
| 186  | VC      | Saint Vincent and the… |        5 |    0.0001% |         50 |      99.92 |
| 186  | SZ      | Eswatini               |        5 |    0.0001% |          4 |    1256.17 |
| 186  | ST      | Sao Tome and Principe  |        5 |    0.0001% |         21 |     240.25 |
| 186  | SS      | South Sudan            |        5 |    0.0001% |        0.4 |   12188.79 |
| 190  | TL      | Timor-Leste            |        4 |   0.00009% |          3 |    1418.52 |
| 190  | PS      | Palestine, State of    |        4 |   0.00009% |        0.7 |    5589.62 |
| 190  | GU      | Guam                   |        4 |   0.00009% |         24 |     169.00 |
| 190  | GQ      | Equatorial Guinea      |        4 |   0.00009% |          2 |    1938.43 |
| 190  | AW      | Aruba                  |        4 |   0.00009% |         37 |     108.15 |
| 195  | SM      | San Marino             |        3 |   0.00007% |         89 |      33.57 |
| 195  | NN      | Sint Maarten (Dutch p… |        3 |   0.00007% |         68 |      43.92 |
| 195  | LS      | Lesotho                |        3 |   0.00007% |          1 |    2363.33 |
| 195  | LC      | Saint Lucia            |        3 |   0.00007% |         17 |     180.15 |
| 195  | KY      | Cayman Islands         |        3 |   0.00007% |         40 |      75.84 |
| 195  | GI      | Gibraltar              |        3 |   0.00007% |         75 |      40.13 |
| 195  | GD      | Grenada                |        3 |   0.00007% |         26 |     117.30 |
| 195  | EH      | Western Sahara         |        3 |   0.00007% |          5 |     600.90 |
| 195  | AI      | Anguilla               |        3 |   0.00007% |        204 |      14.73 |
| 204  | DM      | Dominica               |        2 |   0.00005% |         30 |      65.87 |
| 204  | AS      | American Samoa         |        2 |   0.00005% |         43 |      46.03 |
| 206  | WS      | Samoa                  |        1 |   0.00002% |          5 |     219.31 |
| 206  | TO      | Tonga                  |        1 |   0.00002% |         10 |     103.74 |
| 206  | PW      | Palau                  |        1 |   0.00002% |         57 |      17.66 |
| 206  | NF      | Norfolk Island         |        1 |   0.00002% |            |            |
| 206  | KI      | Kiribati               |        1 |   0.00002% |          7 |     136.49 |
| 206  | IO      | British Indian Ocean … |        1 |   0.00002% |         25 |      39.73 |
| 206  | FK      | Falkland Islands (Mal… |        1 |   0.00002% |        288 |       3.47 |
| 206  | EA      |                        |        1 |   0.00002% |            |            |
| 206  | CK      | Cook Islands           |        1 |   0.00002% |         75 |      13.26 |
| 206  | AG      | Antigua and Barbuda    |        1 |   0.00002% |         11 |      94.21 |
|      | World   | World                  |  4299046 |       100% |        522 | 8231613.07 |
---------------------------------------------------------------------------------------------

Downloading builds from http://stats.lineageos.org. Press 'b' to break downloads.

LineageOS builds by number of installs
----------------------------------------------------------------------------------------------------------------------------------------------
| Rank |      Build       |      Maker      |           Model           |     Processor      | Mod.Released | Status | Installs | % Installs |
----------------------------------------------------------------------------------------------------------------------------------------------
| 1    | channel          | Motorola        | moto g7 play              | Snapdragon 632     | 2019-03-01   | O      |   357490 |      8.32% |
| 2    | dipper           | Xiaomi          | Mi 8                      | Snapdragon 845     | 2018-07-01   | O      |   319905 |      7.44% |
| 3    | lake             | Motorola        | moto g7 plus              | Snapdragon 636     | 2019-02-01   | O      |   191143 |      4.45% |
| 4    | jeter            | Motorola        | moto g6 play              | Snapdragon 430     | 2018-05-01   | U      |   183724 |      4.27% |
| 5    | ocean            | Motorola        | moto g7 power             | Snapdragon 632     | 2019-02-01   | O      |   155544 |      3.62% |
| 6    | beyond0lte       | Samsung         | Galaxy S10e               | Exynos 9820        | 2019-03-08   | O      |   151143 |      3.52% |
| 7    | waydroid_x86_64  | virtual machine | Waydroid on x86_64        | x86                | 2021-07-01   | U      |   146588 |      3.41% |
| 8    | beyond1lte       | Samsung         | Galaxy S10                | Exynos 9820        | 2019-03-08   | O      |   144667 |      3.37% |
| 9    | sanders          | Motorola        | Moto G5S Plus             | Snapdragon 625     | 2017-08-01   | U      |   125849 |      2.93% |
| 10   | beyond2lte       | Samsung         | Galaxy S10+               | Exynos 9825        | 2019-08-23   | O      |   115801 |      2.69% |
| 11   | OP4AA7           | OPPO            | K5                        | Snapdragon 730G    | 2019-10-01   | U      |   114547 |      2.66% |
| 12   | hero2lte         | Samsung         | Galaxy S7 Edge            | Exynos 8890        | 2016-03-18   | D      |   111011 |      2.58% |
| 13   | herolte          | Samsung         | Galaxy S7                 | Exynos 8890        | 2016-03-18   | D      |   107493 |      2.50% |
| 14   | greatlte         | Samsung         | Galaxy Note 8             | Exynos 8895        | 2017-09-01   | U      |   101117 |      2.35% |
| 15   | sagit            | Xiaomi          | Mi 6                      | Snapdragon 835     | 2017-04-01   | O      |    97551 |      2.27% |
| 16   | a71              | Samsung         | Galaxy A71                | Snapdragon 730     | 2020-01-17   | O      |    75976 |      1.77% |
| 17   | ugg              | Xiaomi          | Redmi Note 5A Prime, Red… | Snapdragon 435     | 2017-11-01   | U      |    58500 |      1.36% |
| 18   | A57              | OPPO            | A57 (2016)                | Snapdragon 435     | 2016-12-01   | U      |    58360 |      1.36% |
| 19   | RMX2201CN        | Realme          | V3 5G                     | Dimensity 720      | 2020-09-10   | U      |    57523 |      1.34% |
| 20   | HWPAR            | Huawei          | Nova 3                    | Kirin 970          | 2018-08-01   | U      |    57474 |      1.34% |
| 21   | R9               | OPPO            | R9                        | Helio P10          | 2016-03-01   | U      |    57342 |      1.33% |
| 22   | PACM00           | OPPO            | R15 10                    | Helio P60          | 2018-04-01   | U      |    57281 |      1.33% |
| 23   | prada            | LG              | Prada 3.0                 | OMAP 4430          | 2012-01-01   | U      |    57219 |      1.33% |
| 24   | HWSEA-A          | Huawei          | Nova 5 Pro                | Kirin 980          | 2019-06-01   | U      |    57030 |      1.33% |
| 25   | HWMAR            | Huawei          | P30 Lite                  | Kirin 710          | 2019-04-25   | U      |    57027 |      1.33% |
| 26   | HWDUB-Q          | Huawei          | Y7 Prime 2019             | Snapdragon 450     | 2019-01-01   | U      |    56726 |      1.32% |
| 27   | PBDM00           | OPPO            | R17 Pro / RX17 Pro        | Snapdragon 710     | 2018-11-01   | U      |    56455 |      1.31% |
| 28   | troika           | Motorola        | one action                | Exynos 9609        | 2019-10-31   | O      |    48837 |      1.14% |
| 29   | zerofltexx       | Samsung         | Galaxy S6                 | Exynos 7420        | 2015-04-01   | D      |    48146 |      1.12% |
| 30   | miatoll          | Xiaomi          | POCO M2 Pro, Redmi Note … | Snapdragon 720G    | 2020-07-14   | O      |    34775 |      0.81% |
| 31   | j8y18lte         | Samsung         | J8 (2018)                 | Snapdragon 450     | 2018-07-01   | U      |    28603 |      0.67% |
| 32   | kane             | Motorola        | one vision, p50           | Exynos 9609        | 2019-05-15   | O      |    28271 |      0.66% |
| 33   | river            | Motorola        | moto g7                   | Snapdragon 632     | 2019-02-01   | O      |    25644 |      0.60% |
| 34   | a20              | Samsung         | Galaxy A20                | Exynos 7884        | 2019-04-05   | U      |    24595 |      0.57% |
| 35   | nx_tab           | Nintendo        | Switch v1 [Tablet], Swit… | Tegra X1 (T210)    | 2017-03-03   | O      |    22199 |      0.52% |
| 36   | tiffany          | Xiaomi          | Mi 5X                     | Snapdragon 625     | 2017-09-01   | U      |    17925 |      0.42% |
| 37   | karnak           | Amazon          | Fire HD 8                 | MediaTek MT8163    | 2018-10-04   | U      |    17560 |      0.41% |
| 38   | waydroid_arm64   | virtual machine | Waydroid on ARM64         | ARM                | 2021-07-01   | U      |    14780 |      0.34% |
| 39   | matissewifi      | Samsung         | Galaxy Tab 4 10.1 Wi-Fi   | Snapdragon 400     | 2014-06-01   | U      |    14378 |      0.33% |
| 40   | lavender         | Xiaomi          | Redmi Note 7              | Snapdragon 660     | 2019-01-01   | D      |    13866 |      0.32% |
| 41   | apollon          | Xiaomi          | Mi 10T, Mi 10T Pro, Redm… | Snapdragon 865     | 2020-10-01   | O      |    13174 |      0.31% |
| 42   | a70q             | Samsung         | Galaxy A70 (SM-A705)      | Snapdragon 675     | 2019-05-01   | U      |    12651 |      0.29% |
| 43   | tissot           | Xiaomi          | Mi A1                     | Snapdragon 625     | 2017-10-01   | D      |    11904 |      0.28% |
| 44   | n8000            | Samsung         | Galaxy Note 10.1          | Exynos 4 Quad 4412 | 2012-08-01   | U      |    11011 |      0.26% |
| 45   | j6primelte       | Samsung         | Galaxy J6+                | Snapdragon 425     | 2018-09-25   | U      |    10860 |      0.25% |
| 46   | gtel3g           | Samsung         | Galaxy Tab E              | Spreadtrum SC7730… | 2015-07-01   | U      |    10090 |      0.23% |
| 47   | dumpling         | OnePlus         | OnePlus 5T                | Snapdragon 835     | 2017-11-01   | O      |     9681 |      0.23% |
| 48   | gemini           | Xiaomi          | Mi 5                      | Snapdragon 820     | 2016-04-01   | O      |     9352 |      0.22% |
| 49   | on7xelte         | Samsung         | Galaxy J7 Prime           | Exynos 7870        | 2016-09-01   | U      |     8916 |      0.21% |
| 50   | p10              | Huawei          | P10                       | Kirin 960          | 2017-03-01   | U      |     8812 |      0.20% |
| 51   | n8010            | Samsung         | Galaxy Note 10.1 (N8010)  | Exynos 4 Quad 4412 | 2012-08-01   | U      |     8639 |      0.20% |
| 52   | rpi4             | Raspberry Pi    | Raspberry Pi 4            | Broadcom BCM2711   | 2019-06-24   | U      |     7991 |      0.19% |
| 53   | mustang          |                 |                           |                    |              | U      |     7824 |      0.18% |
| 54   | espresso3g       | Samsung         | Galaxy Tab 2 7.0 (GSM), … | OMAP 4430          | 2012-04-01   | D      |     7756 |      0.18% |
| 55   | a30              | Samsung         | Galaxy A30                | Exynos 7904        | 2019-03-01   | U      |     7690 |      0.18% |
| 56   | Mi439            | Xiaomi          | Redmi 7A, Redmi 8, Redmi… | Snapdragon 439     | 2019-05-28   | O      |     7635 |      0.18% |
| 57   | santos10wifi     | Samsung         | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     7431 |      0.17% |
| 58   | ford             | Amazon          | Fire 7" (ford)            | MediaTek MT8127    | 2015-11-01   | U      |     7174 |      0.17% |
| 59   | j4primelte       | Samsung         | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |     7121 |      0.17% |
| 60   | whyred           | Xiaomi          | Redmi Note 5 Pro          | Snapdragon 636     | 2018-02-01   | D      |     7044 |      0.16% |
| 61   | douglas          | Amazon          | Fire HD 8 (2017)          | MediaTek MT8163    | 2017-06-01   | U      |     6969 |      0.16% |
| 62   | Mi8937           | Xiaomi          | Redmi 3S, Redmi 3X, Redm… | Snapdragon 430     | 2016-06-14   | O      |     6854 |      0.16% |
| 63   | crownlte         | Samsung         | Galaxy Note 9             | Exynos 9810        | 2018-08-09   | D      |     6585 |      0.15% |
| 64   | sweet            | Xiaomi          | Redmi Note 10 Pro, Redmi… | Snapdragon 732G    | 2021-03-01   | O      |     6469 |      0.15% |
| 65   | gtaxlwifi        | Samsung         | Galaxy Tab A 10.1" (2016) | Exynos 7870 Octa   | 2016-05-01   | U      |     6376 |      0.15% |
| 66   | core33g          | Samsung         | Galaxy Core Prime (SM-G3… | Snapdragon 410     | 2014-11-01   | U      |     6332 |      0.15% |
| 67   | TB8703           | Lenovo          | TAB 3 8 Plus              | Snapdragon 625     | 2017-03-01   | U      |     5725 |      0.13% |
| 68   | ginkgo           | Xiaomi          | Redmi Note 8, Redmi Note… | Snapdragon 665     | 2019-08-01   | O      |     5721 |      0.13% |
| 69   | starlte          | Samsung         | Galaxy S9                 | Exynos 9810        | 2018-03-11   | D      |     5574 |      0.13% |
| 70   | montana          | Motorola        | moto g5s                  | Snapdragon 430     | 2017-08-01   | D      |     5375 |      0.13% |
| 71   | star2lte         | Samsung         | Galaxy S9+                | Exynos 9810        | 2018-03-11   | D      |     5253 |      0.12% |
| 72   | a5y17lte         | Samsung         | Galaxy A5 (2017)          | Exynos 7880        | 2017-01-02   | D      |     5229 |      0.12% |
| 73   | beryllium        | Xiaomi          | POCO F1                   | Snapdragon 845     | 2018-08-01   | O      |     5201 |      0.12% |
| 74   | alioth           | Xiaomi          | POCO F3, Redmi K40, Mi 1… | Snapdragon 870     | 2021-03-01   | O      |     5088 |      0.12% |
| 75   | enchilada        | OnePlus         | OnePlus 6                 | Snapdragon 845     | 2018-04-01   | O      |     5061 |      0.12% |
| 76   | klte             | Samsung         | Galaxy S5 LTE (G900F/M/R… | Snapdragon 801     | 2014-04-11   | D      |     4857 |      0.11% |
| 77   | fajita           | OnePlus         | OnePlus 6T, OnePlus 6T (… | Snapdragon 845     | 2018-11-01   | O      |     4851 |      0.11% |
| 78   | m20lte           | Samsung         | Galaxy M20                | Exynos 7904        | 2019-01-28   | D      |     4797 |      0.11% |
| 79   | harpia           | Motorola        | moto g4 play              | Snapdragon 410     | 2016-05-01   | D      |     4712 |      0.11% |
| 80   | rpi5             | Raspberry Pi    | Raspberry Pi 5            | Broadcom BCM2712   | 2023-10-23   | U      |     4692 |      0.11% |
| 81   | n1awifi          | Samsung         | Galaxy Note 10.1 Wi-Fi (… | Exynos 5420        | 2013-10-10   | D      |     4643 |      0.11% |
| 82   | j7elte           | Samsung         | Galaxy J7 (2015)          | Exynos 7580        | 2015-06-01   | D      |     4469 |      0.10% |
| 83   | clover           | Xiaomi          | Xiaomi Mi Pad 4           | Snapdragon 660     | 2018-06-25   | U      |     4433 |      0.10% |
| 84   | gtexslte         | Samsung         | Galaxy Tab A 7.0 LTE (20… | Snapdragon 410     | 2016-03-01   | U      |     4427 |      0.10% |
| 85   | potter           | Motorola        | Moto G5 Plus              | Snapdragon 625     | 2017-04-01   | U      |     4394 |      0.10% |
| 86   | cheeseburger     | OnePlus         | OnePlus 5                 | Snapdragon 835     | 2017-06-01   | O      |     4343 |      0.10% |
| 87   | mido             | Xiaomi          | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | D      |     4304 |      0.10% |
| 88   | mocha            | Xiaomi          | Mi Pad 1                  | Tegra K1 (T124)    | 2014-06-01   | U      |     4235 |      0.10% |
| 89   | r8q              | Samsung         | Galaxy S20 FE, Galaxy S2… | Snapdragon 865     | 2021-04-23   | O      |     4196 |      0.10% |
| 90   | coral            | Google          | Pixel 4 XL                | Snapdragon 855     | 2019-09-01   | O      |     4121 |      0.10% |
| 91   | sunfish          | Google          | Pixel 4a                  | Snapdragon 730G    | 2020-08-01   | O      |     4061 |      0.09% |
| 92   | santos103g       | Samsung         | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     4036 |      0.09% |
| 93   | evert            | Motorola        | moto g6 plus              | Snapdragon 630     | 2018-05-01   | O      |     3992 |      0.09% |
| 94   | hlte             | Samsung         | Galaxy Note 3 LTE (N9005… | Snapdragon 800     | 2013-09-01   | D      |     3899 |      0.09% |
| 95   | austin           | Amazon          | Fire 7" (Austin)          | MediaTek MT8127    | 2017-06-01   | U      |     3870 |      0.09% |
| 96   | espressowifi     | Samsung         | Galaxy Tab 2 7.0 (Wi-Fi … | OMAP 4430          | 2012-05-01   | D      |     3838 |      0.09% |
| 97   | blueline         | Google          | Pixel 3                   | Snapdragon 845     | 2018-10-01   | O      |     3797 |      0.09% |
| 98   | blossom          | Xiaomi          | Redmi 9A, Redmi 9C, Redm… | Helio G25 / G35    | 2020-07-07   | U      |     3757 |      0.09% |
| 99   | flo              | Google          | Nexus 7 (Wi-Fi, 2013 ver… | Snapdragon S4 Pro  | 2013-07-26   | D      |     3632 |      0.08% |
| 100  | rosemary         | Xiaomi          | Redmi Note 10S, Redmi No… | Helio G95          | 2021-04-01   | O      |     3464 |      0.08% |
| 101  | chiron           | Xiaomi          | Mi MIX 2                  | Snapdragon 835     | 2017-09-01   | O      |     3456 |      0.08% |
| 102  | sargo            | Google          | Pixel 3a                  | Snapdragon 670     | 2019-04-01   | O      |     3330 |      0.08% |
| 103  | instantnoodlep   | OnePlus         | OnePlus 8 Pro             | Snapdragon 865     | 2020-04-01   | O      |     3326 |      0.08% |
| 104  | laurel_sprout    | Xiaomi          | Mi A3                     | Snapdragon 665     | 2019-07-01   | O      |     3289 |      0.08% |
| 105  | wayne            | Xiaomi          | Mi 6X                     | Snapdragon 660     | 2018-04-01   | D      |     3253 |      0.08% |
| 106  | vayu             | Xiaomi          | POCO X3 Pro               | Snapdragon 860     | 2021-03-01   | O      |     3222 |      0.07% |
| 107  | n5100            | Samsung         | Galaxy Note 8.0 (GSM)     | Exynos 4412        | 2013-04-01   | D      |     3071 |      0.07% |
| 108  | guacamole        | OnePlus         | OnePlus 7 Pro, OnePlus 7… | Snapdragon 855     | 2019-05-01   | O      |     3026 |      0.07% |
| 109  | redfin           | Google          | Pixel 5                   | Snapdragon 765G 5G | 2020-10-01   | O      |     2997 |      0.07% |
| 110  | nx563j           | Nubia           | Z17                       | Snapdragon 835     | 2017-06-01   | O      |     2996 |      0.07% |
| 111  | gtexswifi        | Samsung         | Galaxy Tab A 7.0          | Spreadtrum SC8830  | 2016-03-01   | U      |     2933 |      0.07% |
| 112  | merlinx          | Xiaomi          | Redmi Note 9              | Helio G85          | 2020-05-01   | D      |     2835 |      0.07% |
| 112  | gtaxllte         | Samsung         | Galaxy Tab A (SM-T580)    | Exynos 7870 Octa   | 2016-05-01   | U      |     2835 |      0.07% |
| 114  | kebab            | OnePlus         | OnePlus 8T, OnePlus 8T (… | Snapdragon 865     | 2020-10-01   | O      |     2824 |      0.07% |
| 115  | x2               | LeEco           | Le Max2                   | Snapdragon 820     | 2016-04-01   | D      |     2815 |      0.07% |
| 115  | surya            | Xiaomi          | POCO X3 NFC               | Snapdragon 732G    | 2020-09-08   | O      |     2815 |      0.07% |
| 117  | chagallwifi      | Samsung         | Galaxy Tab S 10.5 Wi-Fi … | Exynos 5420        | 2014-07-01   | D      |     2799 |      0.07% |
| 118  | gta4xlwifi       | Samsung         | Galaxy Tab S6 Lite (Wi-F… | Exynos 9611        | 2020-04-02   | O      |     2787 |      0.06% |
| 119  | lmi              | Xiaomi          | POCO F2 Pro, Redmi K30 P… | Snapdragon 865     | 2020-05-01   | O      |     2786 |      0.06% |
| 120  | onclite          | Xiaomi          | Redmi 7, Redmi Y3         | Snapdragon 632     | 2019-03-01   | O      |     2785 |      0.06% |
| 121  | viennalte        | Samsung         | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-13   | U      |     2749 |      0.06% |
| 121  | c2502t_cm8900pl… | C Idea          | CM8900 Plus               | Snapdragon QT615   | 2025-09-24   | U      |     2749 |      0.06% |
| 123  | chagalllte       | Samsung         | Galaxy Tab S 10.5 LTE     | Exynos 5420        | 2014-07-01   | D      |     2715 |      0.06% |
| 124  | a10              | Samsung         | Galaxy A10                | Exynos 7884        | 2019-03-01   | U      |     2571 |      0.06% |
| 125  | A37              | OPPO            | A37, A37f, A37fw          | Snapdragon 410     | 2016-06-01   | U      |     2568 |      0.06% |
| 126  | matisse3g        | Samsung         | Galaxy Tab 4 10.1 3G      | Snapdragon 400     | 2014-06-01   | U      |     2462 |      0.06% |
| 127  | gts4lvwifi       | Samsung         | Galaxy Tab S5e (Wi-Fi)    | Snapdragon 670     | 2019-04-01   | O      |     2441 |      0.06% |
| 128  | bacon            | OnePlus         | OnePlus One               | Snapdragon 801     | 2014-06-06   | D      |     2420 |      0.06% |
| 129  | i9300            | Samsung         | Galaxy S III (Internatio… | Exynos 4412        | 2012-05-29   | D      |     2371 |      0.06% |
| 130  | davinci          | Xiaomi          | Mi 9T, Redmi K20 (China)… | Snapdragon 730     | 2019-06-01   | O      |     2369 |      0.06% |
| 131  | lemonade         | OnePlus         | OnePlus 9, OnePlus 9 (T-… | Snapdragon 888     | 2021-03-01   | O      |     2368 |      0.06% |
| 132  | R11              | OPPO            | R11                       | Snapdragon 660     | 2017-06-01   | U      |     2328 |      0.05% |
| 133  | oneplus3         | OnePlus         | OnePlus 3, OnePlus 3T     | Snapdragon 820     | 2016-06-01   | D      |     2318 |      0.05% |
| 134  | mondrianwifi     | Samsung         | Galaxy Tab Pro 8.4        | Snapdragon 800     | 2014-01-01   | D      |     2242 |      0.05% |
| 135  | star2qltechn     | Samsung         | Galaxy S9+                | Snapdragon 845     | 2018-03-16   | U      |     2222 |      0.05% |
| 136  | lemonadep        | OnePlus         | OnePlus 9 Pro, OnePlus 9… | Snapdragon 888     | 2021-03-01   | O      |     2162 |      0.05% |
| 137  | serranoltexx     | Samsung         | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |     2094 |      0.05% |
| 138  | gts210vewifi     | Samsung         | Galaxy Tab S2 9.7 Wi-Fi … | Snapdragon 652     | 2016-08-01   | D      |     2085 |      0.05% |
| 139  | vince            | Xiaomi          | Redmi 5 Plus              | Snapdragon 625     | 2017-12-07   | U      |     2078 |      0.05% |
| 140  | cactus           | Xiaomi          | Redmi 6A                  | Helio A22          | 2018-06-15   | U      |     2076 |      0.05% |
| 141  | garden           | Xiaomi          | Redmi 9A, Redmi 9C        | Helio G25          | 2020-07-07   | U      |     2016 |      0.05% |
| 142  | x86_64_tv        | virtual machine | Android TV on x86_64      | x86                |              | U      |     2011 |      0.05% |
| 143  | j5xnlte          | Samsung         | Galaxy J5 (J510MN/GN/FN)  | Snapdragon 410     | 2016-04-01   | U      |     2006 |      0.05% |
| 144  | android_x86_64   | virtual machine | Android on x86_64         | x86                |              | U      |     1988 |      0.05% |
| 145  | n2awifi          | Samsung         | Galaxy Tab PRO 10.1       | Exynos 5420        | 2014-02-01   | D      |     1953 |      0.05% |
| 146  | matisselte       | Samsung         | Galaxy Tab 4 10.1 LTE     | Snapdragon 400     | 2014-05-01   | U      |     1940 |      0.05% |
| 147  | taimen           | Google          | Pixel 2 XL                | Snapdragon 835     | 2017-10-01   | O      |     1934 |      0.04% |
| 148  | cedric           | Motorola        | moto g5                   | Snapdragon 430     | 2017-03-01   | D      |     1928 |      0.04% |
| 149  | noblelte         | Samsung         | Galaxy Note 5             | Exynos 7420 Octa   | 2015-08-21   | U      |     1905 |      0.04% |
| 150  | walleye          | Google          | Pixel 2                   | Snapdragon 835     | 2017-10-01   | O      |     1881 |      0.04% |
| 151  | umi              | Xiaomi          | Mi 10                     | Snapdragon 865     | 2020-02-01   | O      |     1869 |      0.04% |
| 152  | gta4lwifi        | Samsung         | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1867 |      0.04% |
| 153  | treltexx         | Samsung         | Galaxy Note 4             | Exynos 5433 Octa   | 2014-10-01   | U      |     1822 |      0.04% |
| 154  | grandppltedx     | Samsung         | Galaxy J2 Prime / Grand … | MediaTek MT6737T   | 2016-11-01   | U      |     1820 |      0.04% |
| 155  | helium           | Xiaomi          | Mi Max                    | Snapdragon 652     | 2016-05-01   | U      |     1809 |      0.04% |
| 156  | hammerhead       | Google          | Nexus 5                   | Snapdragon 800     | 2013-10-31   | D      |     1791 |      0.04% |
| 157  | polaris          | Xiaomi          | Mi MIX 2S                 | Snapdragon 845     | 2018-04-01   | O      |     1789 |      0.04% |
| 158  | lisa             | Xiaomi          | Xiaomi 11 Lite 5G NE, Xi… | Snapdragon 778G 5G | 2021-09-01   | O      |     1774 |      0.04% |
| 159  | a7y17lte         | Samsung         | Galaxy A7 (2017)          | Exynos 7880        | 2017-01-02   | D      |     1764 |      0.04% |
| 160  | instantnoodle    | OnePlus         | OnePlus 8, OnePlus 8 (T-… | Snapdragon 865     | 2020-04-01   | O      |     1744 |      0.04% |
| 161  | lancelot         | Xiaomi          | Redmi 9                   | Helio G85          | 2020-06-01   | D      |     1725 |      0.04% |
| 162  | starqltechn      | Samsung         | Galaxy S9                 | Snapdragon 845     | 2018-03-16   | U      |     1723 |      0.04% |
| 163  | hotdogb          | OnePlus         | OnePlus 7T, OnePlus 7T (… | Snapdragon 855+    | 2019-09-01   | O      |     1718 |      0.04% |
| 164  | a52sxq           | Samsung         | Galaxy A52s 5G            | Snapdragon 778G 5G | 2021-09-01   | O      |     1710 |      0.04% |
| 165  | y2s              | Samsung         | Galaxy S20+, Galaxy S20+… | Exynos 990         | 2020-03-06   | U      |     1707 |      0.04% |
| 166  | X00TD            | ASUS            | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | D      |     1700 |      0.04% |
| 167  | crosshatch       | Google          | Pixel 3 XL                | Snapdragon 845     | 2018-10-01   | O      |     1696 |      0.04% |
| 168  | tulip            | ZTE             | Axon 7 Mini               | Snapdragon 617     | 2016-09-01   | D      |     1687 |      0.04% |
| 169  | libra            | Xiaomi          | Mi 4c                     | Snapdragon 808     | 2015-09-01   | D      |     1673 |      0.04% |
| 170  | avicii           | OnePlus         | OnePlus Nord              | Snapdragon 765G    | 2020-07-21   | D      |     1663 |      0.04% |
| 171  | renoir           | Xiaomi          | Mi 11 Lite 5G             | Snapdragon 780G 5G | 2021-03-01   | O      |     1659 |      0.04% |
| 172  | suez             | Amazon          | Fire HD 10                | MediaTek MT8173    | 2017-06-01   | U      |     1648 |      0.04% |
| 173  | a5xelte          | Samsung         | Galaxy A5 (2016)          | Exynos 7580        | 2015-12-01   | D      |     1600 |      0.04% |
| 174  | beyondx          | Samsung         | Galaxy S10 5G             | Exynos 9820        | 2019-03-08   | O      |     1597 |      0.04% |
| 175  | a21s             | Samsung         | Galaxy A21s               | Exynos 850         | 2020-06-02   | O      |     1564 |      0.04% |
| 176  | a6lte            | Samsung         | Galaxy A6 (Exynos7870)    | Exynos 7870        | 2018-05-01   | U      |     1553 |      0.04% |
| 177  | flox             | Google          | Nexus 7 2013 (Wi-Fi, Rep… | Snapdragon S4 Pro  | 2013-07-26   | D      |     1551 |      0.04% |
| 178  | kenzo            | Xiaomi          | Redmi Note 3              | Snapdragon 650     | 2016-02-01   | D      |     1544 |      0.04% |
| 179  | gta4l            | Samsung         | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1532 |      0.04% |
| 180  | jfltexx          | Samsung         | Galaxy S4 (GT-I9505, SGH… | Snapdragon 600     | 2013-04-01   | D      |     1493 |      0.03% |
| 181  | ms013g           | Samsung         | Galaxy Grand 2 Duos       | Snapdragon 400     | 2013-11-25   | D      |     1490 |      0.03% |
| 182  | a7y18lte         | Samsung         | Galaxy A7 (2018)          | Exynos 7 Octa 7885 | 2018-10-01   | U      |     1449 |      0.03% |
| 183  | bonito           | Google          | Pixel 3a XL               | Snapdragon 670     | 2019-04-01   | O      |     1448 |      0.03% |
| 184  | a3xelte          | Samsung         | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | D      |     1442 |      0.03% |
| 185  | n7100            | Samsung         | Galaxy Note II            | Exynos 4412 Quad   | 2012-10-01   | U      |     1417 |      0.03% |
| 186  | marble           | Xiaomi          | POCO F5 (Global), POCO F… | Snapdragon 7+ Gen… | 2023-05-09   | O      |     1413 |      0.03% |
| 187  | D22AP            | virtual machine | Android 12 (API 22)       |                    |              | U      |     1389 |      0.03% |
| 188  | certus           | Xiaomi          | Redmi 6 / 6A              | Helio A22          | 2018-06-01   | U      |     1387 |      0.03% |
| 189  | bluejay          | Google          | Pixel 6a                  | Tensor GS101       | 2022-07-01   | O      |     1361 |      0.03% |
| 190  | TBX704           | Lenovo          | Tab 4 10 Plus             | Snapdragon? 625    | 2017-07-01   | U      |     1344 |      0.03% |
| 191  | gts4lv           | Samsung         | Galaxy Tab S5e (LTE)      | Snapdragon 670     | 2019-04-01   | O      |     1326 |      0.03% |
| 192  | gt58wifi         | Samsung         | Tab A 2015 8.0 (SM-T350)  | Snapdragon 410     | 2015-05-01   | U      |     1323 |      0.03% |
| 193  | lt01wifi         | Samsung         | Galaxy Tab 3 8.0 (SM-T31… | Exynos 4 Dual 4212 | 2013-07-01   | U      |     1297 |      0.03% |
| 194  | v1awifi          | Samsung         | Galaxy Note Pro 12.2 Wi-… | Exynos 5420        | 2014-02-01   | D      |     1274 |      0.03% |
| 195  | grus             | Xiaomi          | Mi 9 SE                   | Snapdragon 712     | 2019-02-01   | O      |     1261 |      0.03% |
| 196  | deen             | Motorola        | One                       | Snapdragon 625     | 2020-07-02   | U      |     1250 |      0.03% |
| 197  | oneplus2         | OnePlus         | OnePlus 2                 | Snapdragon 810     | 2015-08-28   | D      |     1244 |      0.03% |
| 198  | gauguin          | Xiaomi          | Mi 10T Lite 5G, Mi 10i 5… | Snapdragon 750G 5G | 2020-10-01   | O      |     1236 |      0.03% |
| 199  | r36s             | R36S            | R36S with Panel 4         | Rockchip RK3326    | 2025-05-31   | U      |     1225 |      0.03% |
| 200  | n8013            | Samsung         | Galaxy Note 10.1 WiFi     | Exynos 4412        | 2012-08-01   | U      |     1220 |      0.03% |
| 201  | fogos            | Motorola        | moto g34 5G, moto g45 5G  | Snapdragon 695     | 2023-12-29   | O      |     1215 |      0.03% |
| 202  | klimtwifi        | Samsung         | Galaxy Tab S 8.4 Wi-Fi    | Exynos 5420        | 2014-07-01   | D      |     1211 |      0.03% |
| 203  | tokay            | Google          | Pixel 9                   | Tensor G4          | 2024-08-22   | O      |     1210 |      0.03% |
| 204  | flame            | Google          | Pixel 4                   | Snapdragon 855     | 2019-09-01   | O      |     1197 |      0.03% |
| 204  | FP3              | Fairphone       | Fairphone 3, Fairphone 3+ | Snapdragon 632     | 2019-09-01   | O      |     1197 |      0.03% |
| 206  | a52q             | Samsung         | Galaxy A52 4G             | Snapdragon 720G    | 2021-03-26   | O      |     1191 |      0.03% |
| 207  | j5lte            | Samsung         | Galaxy J5 (2015)          | Snapdragon 410     | 2015-06-26   | U      |     1174 |      0.03% |
| 208  | waydroid_x86     | virtual machine | Waydroid on i386          | x86                | 2021-07-01   | U      |     1167 |      0.03% |
| 209  | merlin           | Motorola        | moto g3 turbo             | Snapdragon 615     | 2015-11-01   | D      |     1164 |      0.03% |
| 210  | rpi3             | Raspberry Pi    | Raspberry Pi 3            | Broadcom BCM2837   | 2016-02-29   | U      |     1159 |      0.03% |
| 211  | n5110            | Samsung         | Galaxy Note 8.0 (Wi-Fi)   | Exynos 4412        | 2013-04-01   | D      |     1149 |      0.03% |
| 212  | xmsirius         | Xiaomi          | Mi 8 SE                   | Snapdragon 710     | 2018-06-01   | D      |     1147 |      0.03% |
| 213  | pioneer          | Sony            | Xperia XA2                | Snapdragon 630     | 2018-02-01   | O      |     1139 |      0.03% |
| 214  | violet           | Xiaomi          | Redmi Note 7 Pro          | Snapdragon 675     | 2019-03-13   | O      |     1129 |      0.03% |
| 215  | hydrogen         | Xiaomi          | Mi Max                    | Snapdragon 650     | 2016-05-01   | D      |     1126 |      0.03% |
| 216  | lilac            | Sony            | Xperia XZ1 Compact        | Snapdragon 835     | 2017-10-01   | U      |     1102 |      0.03% |
| 217  | nx               | Nintendo        | Switch v1 [Android TV], … | Tegra X1 (T210)    | 2017-03-03   | O      |     1091 |      0.03% |
| 218  | devon            | Motorola        | moto g32                  | Snapdragon 680 4G  | 2022-08-01   | O      |     1067 |      0.02% |
| 219  | android_x86      | virtual machine | Android on x86            | x86                |              | U      |     1056 |      0.02% |
| 220  | FP4              | Fairphone       | Fairphone 4               | Snapdragon 750G    | 2021-10-01   | O      |     1052 |      0.02% |
| 221  | waydroid_tv_x86… |                 |                           |                    |              | U      |     1039 |      0.02% |
| 222  | hltekor          | Samsung         | Galaxy Note 3 LTE (N900K… | Snapdragon 800     | 2013-09-01   | D      |     1032 |      0.02% |
| 223  | guacamoleb       | OnePlus         | OnePlus 7                 | Snapdragon 855     | 2019-05-01   | O      |     1027 |      0.02% |
| 224  | armani           | Xiaomi          | Redmi 1S                  | Snapdragon 400     | 2014-05-01   | D      |     1020 |      0.02% |
| 225  | mata             | Essential       | PH-1                      | Snapdragon 835     | 2017-08-01   | O      |     1009 |      0.02% |
| 226  | daisy            | Xiaomi          | Mi A2 Lite                | Snapdragon 625     | 2018-07-01   | U      |     1007 |      0.02% |
| 227  | gt510wifi        | Samsung         | Tab A 2015 9.7 SM-T550    | Snapdragon 410     | 2015-05-01   | U      |      999 |      0.02% |
| 228  | bangkk           | Motorola        | moto g84 5G               | Snapdragon 695     | 2023-09-08   | O      |      996 |      0.02% |
| 229  | ha3g             | Samsung         | Galaxy Note 3 (Internati… | Exynos 5420        | 2013-09-01   | D      |      993 |      0.02% |
| 230  | gts3lwifi        | Samsung         | Galaxy Tab S3 WiFi        | Snapdragon 820     | 2017-03-24   | U      |      990 |      0.02% |
| 231  | d2s              | Samsung         | Galaxy Note10+            | Exynos 9825        | 2019-08-23   | O      |      987 |      0.02% |
| 232  | klimtlte         | Samsung         | Galaxy Tab S 10.5 LTE (S… | Exynos 5 Octa 542… | 2014-07-01   | U      |      969 |      0.02% |
| 233  | lynx             | Google          | Pixel 7a                  | Tensor GS201       | 2023-05-10   | O      |      967 |      0.02% |
| 234  | ysl              | Xiaomi          | Redmi S2, Redmi Y2        | Snapdragon 625     | 2018-05-01   | U      |      966 |      0.02% |
| 234  | payton           | Motorola        | moto x4                   | Snapdragon 630     | 2017-10-01   | O      |      966 |      0.02% |
| 236  | n8020            | Samsung         | Galaxy Note 10.1 (N8020)  | Exynos 4 Quad 4412 | 2012-12-01   | U      |      963 |      0.02% |
| 237  | Mi8937_4_19      | Xiaomi          | Redmi 4X                  | Snapdragon 435     | 2017-02-28   | U      |      955 |      0.02% |
| 238  | xz2c             | Sony            | Xperia XZ2 Compact        | Snapdragon 845     | 2018-04-01   | O      |      949 |      0.02% |
| 239  | panther          | Google          | Pixel 7                   | Tensor GS201       | 2022-10-13   | O      |      947 |      0.02% |
| 240  | bramble          | Google          | Pixel 4a 5G               | Snapdragon 765G    | 2020-10-01   | O      |      942 |      0.02% |
| 241  | Mi8917           | Xiaomi          | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-04   | O      |      934 |      0.02% |
| 242  | grandneove3g     | Samsung         | Galaxy Grand Neo Plus     | Spreadtrum SC8830  | 2015-01-01   | U      |      924 |      0.02% |
| 243  | gta4xlveu        |                 |                           |                    |              | U      |      917 |      0.02% |
| 244  | fog              |                 |                           |                    |              | U      |      915 |      0.02% |
| 245  | joan             | LG              | V30 (Unlocked), V30 (T-M… | Snapdragon 835     | 2017-08-01   | O      |      914 |      0.02% |
| 246  | rhode            | Motorola        | moto g52                  | Snapdragon 680 4G  | 2022-04-01   | O      |      909 |      0.02% |
| 247  | athene           | Motorola        | moto g4                   | Snapdragon 617     | 2016-05-01   | D      |      903 |      0.02% |
| 248  | gts28vewifi      | Samsung         | Galaxy Tab S2 8.0 Wi-Fi … | Snapdragon 652     | 2015-09-01   | D      |      897 |      0.02% |
| 249  | s2               | LeEco           | Le 2                      | Snapdragon 652     | 2016-04-01   | D      |      894 |      0.02% |
| 250  | pyxis            | Xiaomi          | Mi CC 9, Mi 9 Lite        | Snapdragon 665     | 2019-07-01   | O      |      881 |      0.02% |
| 251  | bullhead         | Google          | Nexus 5X                  | Snapdragon 808     | 2015-09-29   | D      |      876 |      0.02% |
| 252  | gts210wifi       | Samsung         | Galaxy Tab S2 9.7 (Wi-Fi) | Exynos 5433        | 2015-09-01   | D      |      874 |      0.02% |
| 253  | gts210ltexx      | Samsung         | Galaxy Tab S2 9.7 (LTE)   | Exynos 5433        | 2015-09-01   | D      |      867 |      0.02% |
| 254  | a51              | Samsung         | Galaxy A51 (SM-A515F)     | Exynos 9611        | 2019-12-16   | U      |      866 |      0.02% |
| 255  | PL2              | Nokia           | Nokia 6.1 (2018)          | Snapdragon 630     | 2018-05-06   | O      |      864 |      0.02% |
| 256  | larry            | OnePlus         | OnePlus Nord CE 3 Lite 5… | Snapdragon 695     | 2023-04-11   | O      |      860 |      0.02% |
| 257  | x1s              | Samsung         | Galaxy S20, Galaxy S20 5G | Exynos 990         | 2020-03-06   | U      |      853 |      0.02% |
| 257  | peridot          |                 |                           |                    |              | U      |      853 |      0.02% |
| 259  | rosy             |                 |                           |                    |              | U      |      852 |      0.02% |
| 260  | lt03lte          | Samsung         | Galaxy Note 10.1 2014 (L… | Snapdragon 800     | 2013-10-01   | D      |      848 |      0.02% |
| 260  | guamp            | Motorola        | moto g9 play, moto g9, K… | Snapdragon 662     | 2020-08-01   | O      |      848 |      0.02% |
| 262  | trlte            |                 |                           |                    |              | U      |      842 |      0.02% |
| 263  | gtanotexlwifi    |                 |                           |                    |              | U      |      839 |      0.02% |
| 264  | s5neolte         | Samsung         | Galaxy S5 Neo             | Exynos 7580        | 2015-08-01   | D      |      830 |      0.02% |
| 265  | osprey           | Motorola        | moto g (2015)             | Snapdragon 410     | 2015-07-01   | D      |      827 |      0.02% |
| 266  | oriole           | Google          | Pixel 6                   | Tensor GS101       | 2021-10-19   | O      |      826 |      0.02% |
| 267  | thor             | Xiaomi          | Xiaomi 12S Ultra          | Snapdragon 8+ Gen1 | 2022-07-09   | O      |      824 |      0.02% |
| 268  | spes             |                 |                           |                    |              | U      |      821 |      0.02% |
| 269  | YTX703F          | Lenovo          | Yoga Tab 3 Plus Wi-Fi     | Snapdragon 652     | 2016-12-01   | D      |      813 |      0.02% |
| 270  | gtelwifiue       | Samsung         | Galaxy Tab E 9.6 (WiFi)   | Snapdragon 410     | 2015-07-01   | D      |      809 |      0.02% |
| 271  | jasmine_sprout   | Xiaomi          | Mi A2                     | Snapdragon 660     | 2018-07-01   | D      |      803 |      0.02% |
| 272  | shamu            | Google          | Nexus 6                   | Snapdragon 805     | 2014-10-29   | D      |      800 |      0.02% |
| 273  | ginna            |                 |                           |                    |              | U      |      799 |      0.02% |
| 274  | gtowifi          | Samsung         | Galaxy Tab A 8.0 (2019)   | Snapdragon 429     | 2019-07-01   | O      |      792 |      0.02% |
| 275  | j2y18lte         |                 |                           |                    |              | U      |      791 |      0.02% |
| 276  | kiev             | Motorola        | moto g 5G, moto one 5G a… | Snapdragon 750G    | 2020-05-01   | O      |      785 |      0.02% |
| 277  | fortuna3g        |                 |                           |                    |              | U      |      771 |      0.02% |
| 278  | x86_64           |                 |                           |                    |              | U      |      767 |      0.02% |
| 279  | gts3llte         |                 |                           |                    |              | U      |      759 |      0.02% |
| 280  | nash             | Motorola        | moto z2 force, moto z (2… | Snapdragon 835     | 2017-07-01   | O      |      755 |      0.02% |
| 281  | sofiar           |                 |                           |                    |              | U      |      753 |      0.02% |
| 281  | begonia          |                 |                           |                    |              | U      |      753 |      0.02% |
| 283  | natrium          | Xiaomi          | Mi 5s Plus                | Snapdragon 821     | 2016-10-01   | O      |      747 |      0.02% |
| 283  | j3xlte           | Samsung         | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830… | 2016-05-06   | U      |      747 |      0.02% |
| 283  | hotdog           | OnePlus         | OnePlus 7T Pro            | Snapdragon 855+    | 2019-10-01   | O      |      747 |      0.02% |
| 283  | hermes           | Xiaomi          | Redmi Note 2              | Helio X10          | 2015-08-14   | U      |      747 |      0.02% |
| 287  | falcon           | Motorola        | moto g                    | Snapdragon 400     | 2013-11-01   | D      |      744 |      0.02% |
| 288  | earth            | Xiaomi          | Redmi 12C, Redmi 12C NFC… | Helio G85          | 2023-01-01   | O      |      739 |      0.02% |
| 289  | marlin           | Google          | Pixel XL                  | Snapdragon 821     | 2016-10-01   | O      |      734 |      0.02% |
| 290  | jason            | Xiaomi          | Mi Note 3                 | Snapdragon 660     | 2017-09-01   | D      |      730 |      0.02% |
| 291  | chime            |                 |                           |                    |              | U      |      727 |      0.02% |
| 292  | santoni          | Xiaomi          | Redmi 4(X)                | Snapdragon 435     | 2017-05-01   | D      |      721 |      0.02% |
| 293  | j3xnlte          | Samsung         | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830… | 2016-05-06   | U      |      719 |      0.02% |
| 294  | cepheus          |                 |                           |                    |              | U      |      718 |      0.02% |
| 295  | milletwifi       |                 |                           |                    |              | U      |      715 |      0.02% |
| 296  | sailfish         | Google          | Pixel                     | Snapdragon 821     | 2016-10-01   | O      |      713 |      0.02% |
| 297  | m1721            |                 |                           |                    |              | U      |      702 |      0.02% |
| 298  | aries            |                 |                           |                    |              | U      |      683 |      0.02% |
| 298  | FP5              | Fairphone       | Fairphone 5               | Qualcomm QCM6490   | 2023-08-01   | O      |      683 |      0.02% |
| 300  | zeroltexx        | Samsung         | Galaxy S6 Edge            | Exynos 7420        | 2015-04-01   | D      |      681 |      0.02% |
| 301  | j7xelte          |                 |                           |                    |              | U      |      679 |      0.02% |
| 302  | m8               | HTC             | One (M8)                  | Snapdragon 801     | 2014-03-01   | D      |      678 |      0.02% |
| 303  | platina          | Xiaomi          | Mi 8 Lite                 | Snapdragon 660     | 2018-09-01   | D      |      673 |      0.02% |
| 304  | rova             |                 |                           |                    |              | U      |      671 |      0.02% |
| 305  | gta4xl           | Samsung         | Galaxy Tab S6 Lite (LTE)  | Exynos 9611        | 2020-04-02   | O      |      670 |      0.02% |
| 306  | federer          |                 |                           |                    |              | U      |      669 |      0.02% |
| 307  | lt013g           |                 |                           |                    |              | U      |      667 |      0.02% |
| 308  | deb              | Google          | Nexus 7 2013 (LTE)        | Snapdragon S4 Pro  | 2013-07-26   | D      |      665 |      0.02% |
| 309  | munch            | Xiaomi          | POCO F4, Redmi K40S       | Snapdragon 870     | 2022-06-01   | O      |      663 |      0.02% |
| 309  | golden           |                 |                           |                    |              | U      |      663 |      0.02% |
| 311  | i9082            |                 |                           |                    |              | U      |      660 |      0.02% |
| 312  | x103f            |                 |                           |                    |              | U      |      659 |      0.02% |
| 313  | gracerlte        |                 |                           |                    |              | U      |      649 |      0.02% |
| 314  | caprip           | Motorola        | moto g30, K13 Pro         | Snapdragon 662     | 2021-03-01   | O      |      648 |      0.02% |
| 315  | dubai            | Motorola        | edge 30                   | Snapdragon 778G+ … | 2022-05-01   | O      |      641 |      0.01% |
| 316  | rolex            |                 |                           |                    |              | U      |      640 |      0.01% |
| 317  | fogo             | Motorola        | moto g 5G - 2024          | Snapdragon 765G    | 2020-05-01   | O      |      638 |      0.01% |
| 318  | osborn           |                 |                           |                    |              | U      |      637 |      0.01% |
| 318  | cancro           | Xiaomi          | Mi 3, Mi 4                | Snapdragon 800     | 2013-10-01   | D      |      637 |      0.01% |
| 320  | starfire         |                 |                           |                    |              | U      |      635 |      0.01% |
| 321  | n1a3g            |                 |                           |                    |              | U      |      634 |      0.01% |
| 322  | Spacewar         | Nothing         | Phone (1)                 | Snapdragon 778G+ … | 2022-07-12   | O      |      632 |      0.01% |
| 323  | a7xelte          | Samsung         | Galaxy A7 (2016)          | Exynos 7580        | 2015-12-01   | D      |      631 |      0.01% |
| 324  | g0215d           |                 |                           |                    |              | U      |      624 |      0.01% |
| 325  | ali              |                 |                           |                    |              | U      |      623 |      0.01% |
| 326  | zeroflte         |                 |                           |                    |              | U      |      619 |      0.01% |
| 327  | j2lte            |                 |                           |                    |              | U      |      617 |      0.01% |
| 328  | gts28wifi        |                 |                           |                    |              | U      |      610 |      0.01% |
| 329  | cupid            | Xiaomi          | Xiaomi 12                 | Snapdragon 8 Gen1  | 2021-12-31   | O      |      607 |      0.01% |
| 330  | odroidn2         |                 |                           |                    |              | U      |      598 |      0.01% |
| 331  | dre              | OnePlus         | OnePlus Nord N200         | Snapdragon 480     | 2021-06-21   | O      |      597 |      0.01% |
| 331  | cheetah          | Google          | Pixel 7 Pro               | Tensor GS201       | 2022-10-13   | O      |      597 |      0.01% |
| 331  | billie           | OnePlus         | OnePlus Nord N10          | Snapdragon 690 5G  | 2020-10-26   | O      |      597 |      0.01% |
| 334  | akita            | Google          | Pixel 8a                  | Tensor G3          | 2023-10-04   | O      |      591 |      0.01% |
| 335  | ugglite          |                 |                           |                    |              | U      |      587 |      0.01% |
| 336  | jasmine          | ZTE             | AT&T Trek 2 HD            | Snapdragon 617     | 2016-08-01   | D      |      582 |      0.01% |
| 337  | grouper          |                 |                           |                    |              | U      |      579 |      0.01% |
| 337  | d2x              | Samsung         | Galaxy Note10+ 5G         | Exynos 9825        | 2019-08-23   | O      |      579 |      0.01% |
| 337  | akari            | Sony            | Xperia XZ2                | Snapdragon 845     | 2018-04-01   | O      |      579 |      0.01% |
| 340  | latte            |                 |                           |                    |              | U      |      574 |      0.01% |
| 341  | hulkbuster       |                 |                           |                    |              | U      |      571 |      0.01% |
| 342  | raven            | Google          | Pixel 6 Pro               | Tensor GS101       | 2021-10-19   | O      |      563 |      0.01% |
| 343  | i9100            | Samsung         | Galaxy S II               | Exynos 4210        | 2011-02-11   | D      |      561 |      0.01% |
| 344  | perseus          | Xiaomi          | Mi MIX 3                  | Snapdragon 845     | 2018-11-01   | O      |      550 |      0.01% |
| 345  | maple_dsds       |                 |                           |                    |              | U      |      549 |      0.01% |
| 346  | shiba            | Google          | Pixel 8                   | Tensor G3          | 2023-10-04   | O      |      546 |      0.01% |
| 347  | salami           | OnePlus         | OnePlus 11 5G             | Snapdragon 8 Gen2  | 2023-01-01   | O      |      544 |      0.01% |
| 347  | angler           | Google          | Nexus 6P                  | Snapdragon 810     | 2015-09-29   | D      |      544 |      0.01% |
| 349  | j7velte          |                 |                           |                    |              | U      |      537 |      0.01% |
| 349  | angelica         |                 |                           |                    |              | U      |      537 |      0.01% |
| 351  | haydn            | Xiaomi          | Mi 11i, Redmi K40 Pro, R… | Snapdragon 888     | 2021-01-01   | O      |      528 |      0.01% |
| 352  | fleur            |                 |                           |                    |              | U      |      526 |      0.01% |
| 352  | a3y17lte         |                 |                           |                    |              | U      |      526 |      0.01% |
| 354  | lt033g           |                 |                           |                    |              | U      |      522 |      0.01% |
| 354  | bach             |                 |                           |                    |              | U      |      522 |      0.01% |
| 356  | twolip           | Xiaomi          | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | D      |      519 |      0.01% |
| 357  | s3ve3gjv         | Samsung         | Galaxy S III Neo (Samsun… | Snapdragon 400     | 2014-04-11   | D      |      518 |      0.01% |
| 358  | kyleproxx        |                 |                           |                    |              | U      |      510 |      0.01% |
| 359  | ido              | Xiaomi          | Redmi 3, Redmi 3 Prime    | Snapdragon 616     | 2016-01-01   | D      |      507 |      0.01% |
| 360  | millet3g         |                 |                           |                    |              | U      |      503 |      0.01% |
| 361  | t0lte            | Samsung         | Galaxy Note 2 (LTE)       | Exynos 4412        | 2012-09-01   | D      |      500 |      0.01% |
| 362  | serrano3gxx      | Samsung         | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      497 |      0.01% |
| 363  | barbet           | Google          | Pixel 5a                  | Snapdragon 765G    | 2021-08-01   | O      |      496 |      0.01% |
| 364  | ks01ltexx        |                 |                           |                    |              | U      |      494 |      0.01% |
| 364  | jfvelte          | Samsung         | Galaxy S4 Value Edition … | Snapdragon 600     | 2014-04-01   | D      |      494 |      0.01% |
| 366  | onyx             | OnePlus         | OnePlus X                 | Snapdragon 801     | 2015-11-01   | D      |      493 |      0.01% |
| 367  | cereus           |                 |                           |                    |              | U      |      492 |      0.01% |
| 368  | gts210velte      |                 |                           |                    |              | U      |      490 |      0.01% |
| 369  | gts28ltexx       |                 |                           |                    |              | U      |      489 |      0.01% |
| 370  | kuntao           | Lenovo          | P2                        | Snapdragon 625     | 2016-11-01   | D      |      482 |      0.01% |
| 371  | x86_64_tv_go     |                 |                           |                    |              | U      |      481 |      0.01% |
| 372  | a3lte            |                 |                           |                    |              | U      |      480 |      0.01% |
| 373  | flashlmdd        | LG              | V50 ThinQ                 | Snapdragon 855     | 2019-02-01   | O      |      477 |      0.01% |
| 374  | foster           | NVIDIA          | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      476 |      0.01% |
| 375  | serranodsdd      | Samsung         | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      475 |      0.01% |
| 376  | pdx206           | Sony            | Xperia 5 II               | Snapdragon 865     | 2020-09-01   | O      |      471 |      0.01% |
| 376  | cmi              | Xiaomi          | Mi 10 Pro                 | Snapdragon 865     | 2020-02-01   | O      |      471 |      0.01% |
| 378  | berlin           | Motorola        | edge 20                   | Snapdragon 778G 5G | 2021-07-29   | O      |      470 |      0.01% |
| 379  | topaz            |                 |                           |                    |              | U      |      462 |      0.01% |
| 380  | wseries          |                 |                           |                    |              | U      |      461 |      0.01% |
| 381  | pdx215           | Sony            | Xperia 1 III              | Snapdragon 888     | 2021-04-01   | O      |      457 |      0.01% |
| 382  | s3ve3gds         | Samsung         | Galaxy S III Neo (Dual S… | Snapdragon 400     | 2014-04-11   | D      |      455 |      0.01% |
| 382  | kugo             | Sony            | Xperia X Compact          | Snapdragon 650     | 2016-09-08   | D      |      455 |      0.01% |
| 384  | garnet           |                 |                           |                    |              | U      |      454 |      0.01% |
| 385  | kminilte         |                 |                           |                    |              | U      |      447 |      0.01% |
| 385  | j7y17lte         |                 |                           |                    |              | U      |      447 |      0.01% |
| 385  | equuleus         | Xiaomi          | Mi 8 Pro                  | Snapdragon 845     | 2018-09-01   | O      |      447 |      0.01% |
| 388  | titan            | Motorola        | moto g (2014)             | Snapdragon 400     | 2014-06-01   | D      |      446 |      0.01% |
| 389  | nio              | Motorola        | edge s, moto g100         | Snapdragon 870     | 2021-02-01   | O      |      444 |      0.01% |
| 389  | husky            | Google          | Pixel 8 Pro               | Tensor G3          | 2023-10-04   | O      |      444 |      0.01% |
| 389  | akatsuki         | Sony            | Xperia XZ3                | Snapdragon 845     | 2018-10-01   | O      |      444 |      0.01% |
| 392  | mh2lm            | LG              | G8X ThinQ (G850EM/EMW), … | Snapdragon 855     | 2019-06-01   | O      |      442 |      0.01% |
| 393  | gts7lwifi        | Samsung         | Galaxy Tab S7 (Wi-Fi)     | Snapdragon 865+    | 2020-08-21   | O      |      441 |      0.01% |
| 394  | zerolte          |                 |                           |                    |              | U      |      439 |      0.01% |
| 395  | d1               | Samsung         | Galaxy Note10             | Exynos 9825        | 2019-08-23   | O      |      432 |      0.01% |
| 396  | cannon           |                 |                           |                    |              | U      |      431 |      0.01% |
| 397  | sheldon          |                 |                           |                    |              | U      |      428 |     0.010% |
| 397  | m7               | HTC             | One (GSM)                 | Snapdragon 600     | 2013-03-01   | D      |      428 |     0.010% |
| 397  | kirin            | Sony            | Xperia 10                 | Snapdragon 630     | 2019-02-01   | O      |      428 |     0.010% |
| 400  | mondrian         | Xiaomi          | POCO F5 Pro, Redmi K60    | Snapdragon 8+ Gen1 | 2023-05-09   | O      |      427 |     0.010% |
| 400  | grandprimeve3g   |                 |                           |                    |              | U      |      427 |     0.010% |
| 400  | a505f            |                 |                           |                    |              | U      |      427 |     0.010% |
| 403  | ingres           |                 |                           |                    |              | U      |      425 |     0.010% |
| 404  | raphael          |                 |                           |                    |              | U      |      422 |     0.010% |
| 405  | selene           |                 |                           |                    |              | U      |      421 |     0.010% |
| 406  | j5nlte           |                 |                           |                    |              | U      |      420 |     0.010% |
| 406  | gta2xlwifi       |                 |                           |                    |              | U      |      420 |     0.010% |
| 408  | pdx203           | Sony            | Xperia 1 II               | Snapdragon 865     | 2020-05-01   | O      |      419 |     0.010% |
| 408  | gtanotexllte     |                 |                           |                    |              | U      |      419 |     0.010% |
| 408  | TB8704           |                 |                           |                    |              | U      |      419 |     0.010% |
| 411  | aura             | Razer           | Phone 2                   | Snapdragon 845     | 2018-10-01   | O      |      418 |     0.010% |
| 412  | waffle           | OnePlus         | OnePlus 12                | Snapdragon 8 Gen3  | 2023-12-01   | O      |      416 |     0.010% |
| 412  | capricorn        | Xiaomi          | Mi 5s                     | Snapdragon 821     | 2016-10-01   | D      |      416 |     0.010% |
| 414  | pollux_windy     | Sony            | Xperia Tablet Z Wi-Fi     | Snapdragon S4 Pro  | 2013-02-01   | D      |      415 |     0.010% |
| 415  | riva             |                 |                           |                    |              | U      |      413 |     0.010% |
| 415  | a72q             | Samsung         | Galaxy A72                | Snapdragon 720G    | 2021-03-26   | O      |      413 |     0.010% |
| 417  | fuxi             | Xiaomi          | Xiaomi 13                 | Snapdragon 8 Gen2  | 2022-12-11   | O      |      412 |     0.010% |
| 418  | v1a3g            |                 |                           |                    |              | U      |      411 |     0.010% |
| 418  | d1x              | Samsung         | Galaxy Note10 5G          | Exynos 9825        | 2019-08-23   | O      |      411 |     0.010% |
| 420  | Mi439_4_19       |                 |                           |                    |              | U      |      408 |     0.009% |
| 421  | xpeng            | Motorola        | moto g200 5G, Edge S30    | Snapdragon 888+    | 2021-11-01   | O      |      405 |     0.009% |
| 421  | oxygen           |                 |                           |                    |              | U      |      405 |     0.009% |
| 423  | j53gxx           |                 |                           |                    |              | U      |      402 |     0.009% |
| 424  | surnia           | Motorola        | moto e LTE (2015)         | Snapdragon 410     | 2015-02-01   | D      |      398 |     0.009% |
| 425  | Pong             | Nothing         | Phone (2)                 | Snapdragon 8+ Gen1 | 2023-07-11   | O      |      397 |     0.009% |
| 426  | hawao            | Motorola        | moto g42                  | Snapdragon 680 4G  | 2022-06-01   | O      |      396 |     0.009% |
| 427  | camellia         |                 |                           |                    |              | U      |      395 |     0.009% |
| 428  | tucana           | Xiaomi          | Mi Note 10, Mi Note 10 P… | Snapdragon 730G    | 2019-11-11   | O      |      390 |     0.009% |
| 429  | lemonades        | OnePlus         | OnePlus 9R                | Snapdragon 888     | 2021-03-01   | O      |      385 |     0.009% |
| 429  | judyln           | LG              | G7 ThinQ (G710AWM/EM/EMW… | Snapdragon 845     | 2018-05-02   | O      |      385 |     0.009% |
| 431  | markw            |                 |                           |                    |              | U      |      384 |     0.009% |
| 432  | stone            |                 |                           |                    |              | U      |      383 |     0.009% |
| 433  | x1q              |                 |                           |                    |              | U      |      382 |     0.009% |
| 434  | sumire           | Sony            | Xperia Z5                 | Snapdragon 810     | 2015-09-01   | D      |      379 |     0.009% |
| 435  | TB8504           |                 |                           |                    |              | U      |      376 |     0.009% |
| 436  | trelteskt        |                 |                           |                    |              | U      |      374 |     0.009% |
| 436  | mondrianlte      |                 |                           |                    |              | U      |      374 |     0.009% |
| 438  | waydroid_arm64_… |                 |                           |                    |              | U      |      371 |     0.009% |
| 439  | zeus             | Xiaomi          | Xiaomi 12 Pro             | Snapdragon 8 Gen1  | 2021-12-31   | O      |      370 |     0.009% |
| 440  | veux             |                 |                           |                    |              | U      |      369 |     0.009% |
| 441  | nairo            | Motorola        | moto g 5G plus, moto one… | Snapdragon 662     | 2021-01-01   | O      |      366 |     0.009% |
| 441  | duchamp          |                 |                           |                    |              | U      |      366 |     0.009% |
| 443  | rtwo             | Motorola        | edge 40 pro, moto X40 ed… | Snapdragon 8 Gen2  | 2023-04-01   | O      |      363 |     0.008% |
| 444  | zenlte           |                 |                           |                    |              | U      |      361 |     0.008% |
| 445  | zl1              | LeEco           | Le Pro3, Le Pro3 Elite    | Snapdragon 821     | 2016-10-01   | D      |      359 |     0.008% |
| 445  | cebu             | Motorola        | moto g9 power, K12 Pro    | Snapdragon 662     | 2020-11-01   | O      |      359 |     0.008% |
| 447  | RM6785           |                 |                           |                    |              | U      |      357 |     0.008% |
| 448  | wt88047          | Wingtech        | Redmi 2                   | Snapdragon 410     | 2015-01-01   | D      |      355 |     0.008% |
| 449  | s3ve3gxx         | Samsung         | Galaxy S III Neo (Sony C… | Snapdragon 400     | 2014-04-11   | D      |      353 |     0.008% |
| 450  | DRG              | Nokia           | Nokia 6.1 Plus            | Snapdragon 636     | 2018-08-30   | D      |      352 |     0.008% |
| 451  | timelm           |                 |                           |                    |              | U      |      351 |     0.008% |
| 452  | gt510lte         |                 |                           |                    |              | U      |      350 |     0.008% |
| 453  | gt5note10wifi    |                 |                           |                    |              | U      |      345 |     0.008% |
| 454  | castor_windy     | Sony            | Xperia Tablet Z2 Wi-Fi    | Snapdragon 801     | 2014-03-26   | D      |      344 |     0.008% |
| 455  | discovery        | Sony            | Xperia XA2 Ultra          | Snapdragon 630     | 2018-02-01   | O      |      343 |     0.008% |
| 456  | tangorpro        | Google          | Pixel Tablet              | Tensor GS201       | 2023-06-10   | O      |      341 |     0.008% |
| 457  | borneo           | Motorola        | moto g power 2021         | Snapdragon 662     | 2021-01-01   | O      |      340 |     0.008% |
| 458  | maple            |                 |                           |                    |              | U      |      338 |     0.008% |
| 458  | hltetmo          | Samsung         | Galaxy Note 3 LTE (N900T… | Snapdragon 800     | 2013-09-01   | D      |      338 |     0.008% |
| 460  | z3tcw            |                 |                           |                    |              | U      |      336 |     0.008% |
| 461  | pdx214           | Sony            | Xperia 5 III              | Snapdragon 888     | 2021-04-01   | O      |      335 |     0.008% |
| 461  | Z01R             | ASUS            | Zenfone 5Z (ZS620KL)      | Snapdragon 845     | 2018-06-01   | O      |      335 |     0.008% |
| 463  | bardockpro       | BQ              | Aquaris X Pro             | Snapdragon 626     | 2017-06-01   | D      |      332 |     0.008% |
| 464  | z2_plus          | ZUK             | Z2 Plus                   | Snapdragon 820     | 2016-06-01   | D      |      329 |     0.008% |
| 464  | v2awifi          |                 |                           |                    |              | U      |      329 |     0.008% |
| 464  | shieldtablet     | NVIDIA          | Shield Tablet             | Tegra K1 (T124)    | 2014-07-29   | D      |      329 |     0.008% |
| 467  | diting           | Xiaomi          | Xiaomi 12T Pro, Redmi K5… | Snapdragon 8+ Gen1 | 2022-10-06   | O      |      327 |     0.008% |
| 468  | guam             | Motorola        | moto e7 plus, K12         | Snapdragon 460     | 2020-09-16   | O      |      326 |     0.008% |
| 469  | santos10lte      |                 |                           |                    |              | U      |      325 |     0.008% |
| 470  | komodo           | Google          | Pixel 9 Pro XL            | Tensor G4          | 2024-08-22   | O      |      323 |     0.008% |
| 470  | TBX304           |                 |                           |                    |              | U      |      323 |     0.008% |
| 472  | R9s              |                 |                           |                    |              | U      |      322 |     0.007% |
| 473  | karin            | Sony            | Xperia Z4 Tablet LTE      | Snapdragon 810     | 2015-10-01   | D      |      321 |     0.007% |
| 473  | hanoip           |                 |                           |                    |              | U      |      321 |     0.007% |
| 475  | zenfone3         | ASUS            | Zenfone 3                 | Snapdragon 625     | 2016-05-30   | D      |      319 |     0.007% |
| 476  | hltedcm          |                 |                           |                    |              | U      |      317 |     0.007% |
| 477  | suzuran          | Sony            | Xperia Z5 Compact         | Snapdragon 810     | 2015-10-01   | D      |      315 |     0.007% |
| 478  | manta            | Google          | Nexus 10                  | Exynos 5250        | 2012-11-13   | D      |      314 |     0.007% |
| 479  | d802             | LG              | G2 (International)        | Snapdragon 800     | 2013-09-12   | D      |      313 |     0.007% |
| 480  | n8000_deodexed   |                 |                           |                    |              | U      |      308 |     0.007% |
| 481  | gts28velte       |                 |                           |                    |              | U      |      306 |     0.007% |
| 482  | dragon           | Google          | Pixel C                   | Tegra X1 (T210)    | 2015-12-08   | D      |      305 |     0.007% |
| 483  | phoenix          |                 |                           |                    |              | U      |      304 |     0.007% |
| 484  | pdx234           | Sony            | Xperia 1 V                | Snapdragon 8 Gen2  | 2023-05-01   | O      |      299 |     0.007% |
| 484  | a73xq            | Samsung         | Galaxy A73 5G             | Snapdragon 778G 5G | 2022-04-22   | O      |      299 |     0.007% |
| 486  | suzu             | Sony            | Xperia X                  | Snapdragon 650     | 2016-05-01   | D      |      298 |     0.007% |
| 487  | ocn              |                 |                           |                    |              | U      |      297 |     0.007% |
| 487  | a5lte            |                 |                           |                    |              | U      |      297 |     0.007% |
| 489  | beckham          | Motorola        | moto z3 play              | Snapdragon 636     | 2018-06-01   | O      |      295 |     0.007% |
| 490  | klteduos         | Samsung         | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-06-01   | D      |      293 |     0.007% |
| 490  | j6lte            |                 |                           |                    |              | U      |      293 |     0.007% |
| 492  | miami            | Motorola        | edge 30 neo               | Snapdragon 695     | 2022-10-07   | O      |      292 |     0.007% |
| 492  | kltekor          | Samsung         | Galaxy S5 LTE (G900K/L/S) | Snapdragon 801     | 2014-04-01   | D      |      292 |     0.007% |
| 494  | m52xq            | Samsung         | Galaxy M52 5G             | Snapdragon 778G 5G | 2021-10-03   | O      |      291 |     0.007% |
| 495  | martini          | OnePlus         | OnePlus 9RT               | Snapdragon 888     | 2021-10-01   | O      |      286 |     0.007% |
| 496  | dm1q             |                 |                           |                    |              | U      |      283 |     0.007% |
| 497  | sunny            |                 |                           |                    |              | U      |      281 |     0.007% |
| 498  | sakura           |                 |                           |                    |              | U      |      279 |     0.006% |
| 499  | YTX703L          | Lenovo          | Yoga Tab 3 Plus LTE       | Snapdragon 652     | 2016-12-01   | D      |      277 |     0.006% |
| 500  | spaced           |                 |                           |                    |              | U      |      276 |     0.006% |
| 500  | castor           | Sony            | Xperia Tablet Z2 LTE      | Snapdragon 801     | 2014-03-26   | D      |      276 |     0.006% |
| 502  | gvwifi           |                 |                           |                    |              | U      |      275 |     0.006% |
| 503  | serranovelte     |                 |                           |                    |              | U      |      273 |     0.006% |
| 503  | judypn           | LG              | V40 ThinQ                 | Snapdragon 845     | 2018-10-03   | O      |      273 |     0.006% |
| 505  | pollux           | Sony            | Xperia Tablet Z LTE       | Snapdragon S4 Pro  | 2013-02-01   | D      |      272 |     0.006% |
| 505  | kiwi             | Huawei          | Honor 5X                  | Snapdragon 616     | 2015-11-01   | D      |      272 |     0.006% |
| 505  | alphaplus        | LG              | G8 ThinQ, G8 ThinQ (Kore… | Snapdragon 855     | 2019-02-01   | O      |      272 |     0.006% |
| 508  | r8s              |                 |                           |                    |              | U      |      271 |     0.006% |
| 509  | m31              |                 |                           |                    |              | U      |      270 |     0.006% |
| 510  | aston            | OnePlus         | OnePlus 12R               | Snapdragon 8 Gen2  | 2024-01-01   | O      |      269 |     0.006% |
| 511  | j5y17lte         |                 |                           |                    |              | U      |      266 |     0.006% |
| 511  | hltechn          | Samsung         | Galaxy Note 3 LTE (N9008… | Snapdragon 800     | 2013-09-01   | D      |      266 |     0.006% |
| 511  | a40              |                 |                           |                    |              | U      |      266 |     0.006% |
| 514  | picassolte       |                 |                           |                    |              | U      |      264 |     0.006% |
| 514  | oscaro           | OnePlus         | OnePlus Nord CE 2 Lite 5G | Snapdragon 695     | 2022-04-30   | O      |      264 |     0.006% |
| 514  | m23xq            |                 |                           |                    |              | U      |      264 |     0.006% |
| 514  | a505fn           |                 |                           |                    |              | U      |      264 |     0.006% |
| 518  | milletlte        |                 |                           |                    |              | U      |      261 |     0.006% |
| 519  | rhodep           | Motorola        | moto g82 5G               | Snapdragon 695     | 2022-06-07   | O      |      260 |     0.006% |
| 519  | caiman           | Google          | Pixel 9 Pro               | Tensor G4          | 2024-09-09   | O      |      260 |     0.006% |
| 521  | z3               | Sony            | Xperia Z3                 | Snapdragon 801     | 2014-09-04   | D      |      259 |     0.006% |
| 521  | lava             |                 |                           |                    |              | U      |      259 |     0.006% |
| 523  | land             | Xiaomi          | Redmi 3S, Redmi 3X        | Snapdragon 430     | 2016-06-01   | D      |      256 |     0.006% |
| 524  | bardock          | BQ              | Aquaris X                 | Snapdragon 626     | 2017-06-01   | D      |      254 |     0.006% |
| 524  | apollo           |                 |                           |                    |              | U      |      254 |     0.006% |
| 526  | racer            | Motorola        | edge                      | Snapdragon 765G    | 2020-05-01   | O      |      253 |     0.006% |
| 527  | r9s              |                 |                           |                    |              | U      |      250 |     0.006% |
| 528  | sky              |                 |                           |                    |              | U      |      247 |     0.006% |
| 529  | pstar            | Motorola        | edge 20 pro               | Snapdragon 870     | 2021-08-01   | O      |      244 |     0.006% |
| 529  | nitrogen         |                 |                           |                    |              | U      |      244 |     0.006% |
| 531  | ovaltine         |                 |                           |                    |              | U      |      241 |     0.006% |
| 532  | X00T             |                 |                           |                    |              | U      |      240 |     0.006% |
| 533  | venus            |                 |                           |                    |              | U      |      235 |     0.005% |
| 534  | dodge            |                 |                           |                    |              | U      |      232 |     0.005% |
| 534  | d855             | LG              | G3 (International)        | Snapdragon 801     | 2014-06-01   | D      |      232 |     0.005% |
| 536  | oce              |                 |                           |                    |              | U      |      231 |     0.005% |
| 537  | mako             | Google          | Nexus 4                   | Snapdragon S4 Pro  | 2012-11-13   | D      |      226 |     0.005% |
| 538  | p3s              |                 |                           |                    |              | U      |      225 |     0.005% |
| 538  | kltedv           | Samsung         | Galaxy S5 LTE (G900I/P)   | Snapdragon 801     | 2014-04-01   | D      |      225 |     0.005% |
| 540  | sirius           | Sony            | Xperia Z2                 | Snapdragon 801     | 2014-04-01   | D      |      224 |     0.005% |
| 540  | grandprimevelte  |                 |                           |                    |              | U      |      224 |     0.005% |
| 542  | ariel            |                 |                           |                    |              | U      |      223 |     0.005% |
| 542  | a53x             |                 |                           |                    |              | U      |      223 |     0.005% |
| 544  | beyond1          |                 |                           |                    |              | U      |      220 |     0.005% |
| 544  | RMX2185          |                 |                           |                    |              | U      |      220 |     0.005% |
| 546  | togari           |                 |                           |                    |              | U      |      219 |     0.005% |
| 547  | pine             |                 |                           |                    |              | U      |      218 |     0.005% |
| 547  | o1s              |                 |                           |                    |              | U      |      218 |     0.005% |
| 547  | dm3q             |                 |                           |                    |              | U      |      218 |     0.005% |
| 550  | kansas           |                 |                           |                    |              | U      |      217 |     0.005% |
| 550  | TB2-X30L         |                 |                           |                    |              | U      |      217 |     0.005% |
| 550  | FP2              | Fairphone       | Fairphone 2               | Snapdragon 801     | 2015-12-01   | D      |      217 |     0.005% |
| 553  | giza             |                 |                           |                    |              | U      |      216 |     0.005% |
| 554  | poplar           |                 |                           |                    |              | U      |      213 |     0.005% |
| 555  | a54x             |                 |                           |                    |              | U      |      212 |     0.005% |
| 556  | addison          | Motorola        | moto z play               | Snapdragon 625     | 2016-09-01   | D      |      211 |     0.005% |
| 557  | A102             |                 |                           |                    |              | U      |      210 |     0.005% |
| 558  | amami            |                 |                           |                    |              | U      |      209 |     0.005% |
| 559  | z3tc             |                 |                           |                    |              | U      |      207 |     0.005% |
| 559  | beethoven        |                 |                           |                    |              | U      |      207 |     0.005% |
| 561  | griffin          | Motorola        | moto z                    | Snapdragon 820     | 2016-09-01   | D      |      206 |     0.005% |
| 561  | capri            | Motorola        | moto g10, moto g10 power… | Snapdragon 460     | 2021-02-01   | O      |      206 |     0.005% |
| 563  | virtio_arm64only |                 |                           |                    |              | U      |      205 |     0.005% |
| 564  | gt5note10lte     |                 |                           |                    |              | U      |      204 |     0.005% |
| 565  | q5q              |                 |                           |                    |              | U      |      203 |     0.005% |
| 565  | btv              |                 |                           |                    |              | U      |      203 |     0.005% |
| 567  | amar_row_lte     |                 |                           |                    |              | U      |      202 |     0.005% |
| 568  | sea              |                 |                           |                    |              | U      |      201 |     0.005% |
| 568  | degaslte         |                 |                           |                    |              | U      |      201 |     0.005% |
| 570  | b2q              |                 |                           |                    |              | U      |      200 |     0.005% |
| 571  | tanzanite        |                 |                           |                    |              | U      |      199 |     0.005% |
| 572  | sapphire         |                 |                           |                    |              | U      |      198 |     0.005% |
| 573  | honami           |                 |                           |                    |              | U      |      197 |     0.005% |
| 573  | btvdl09          |                 |                           |                    |              | U      |      197 |     0.005% |
| 575  | xun              |                 |                           |                    |              | U      |      196 |     0.005% |
| 575  | v500             | LG              | G Pad 8.3                 | Snapdragon 600     | 2013-10-14   | D      |      196 |     0.005% |
| 575  | flounder         | Google          | Nexus 9 (Wi-Fi)           | Tegra K1 (T124)    | 2014-11-03   | D      |      196 |     0.005% |
| 578  | pdx235           | Sony            | Xperia 10 V               | Snapdragon 695     | 2023-06-21   | O      |      195 |     0.005% |
| 579  | tblte            |                 |                           |                    |              | U      |      194 |     0.005% |
| 579  | giulia           |                 |                           |                    |              | U      |      194 |     0.005% |
| 581  | odroidxu3        |                 |                           |                    |              | U      |      192 |     0.004% |
| 582  | socrates         | Xiaomi          | Redmi K60 Pro             | Snapdragon 8 Gen2  | 2022-12-27   | O      |      191 |     0.004% |
| 583  | z3c              | Sony            | Xperia Z3 Compact         | Snapdragon 801     | 2014-09-04   | D      |      190 |     0.004% |
| 583  | pipa             |                 |                           |                    |              | U      |      190 |     0.004% |
| 583  | i9305            | Samsung         | Galaxy S III (LTE / Inte… | Exynos 4412        | 2012-10-01   | D      |      190 |     0.004% |
| 583  | NB1              | Nokia           | Nokia 8                   | Snapdragon 835     | 2017-08-16   | O      |      190 |     0.004% |
| 587  | pdx225           | Sony            | Xperia 10 IV              | Snapdragon 695     | 2022-06-30   | O      |      189 |     0.004% |
| 587  | lux              | Motorola        | moto x play               | Snapdragon 615     | 2015-08-01   | D      |      189 |     0.004% |
| 589  | nabu             |                 |                           |                    |              | U      |      188 |     0.004% |
| 590  | xaga             |                 |                           |                    |              | U      |      187 |     0.004% |
| 590  | tre3calteskt     |                 |                           |                    |              | U      |      187 |     0.004% |
| 590  | j1xlte           |                 |                           |                    |              | U      |      187 |     0.004% |
| 593  | b5q              |                 |                           |                    |              | U      |      185 |     0.004% |
| 594  | cheryl           | Razer           | Phone                     | Snapdragon 835     | 2017-11-01   | O      |      184 |     0.004% |
| 595  | thyme            | Xiaomi          | Mi 10S                    | Snapdragon 870     | 2021-03-01   | O      |      183 |     0.004% |
| 596  | monet            | Xiaomi          | Mi 10 Lite 5G             | Snapdragon 765G    | 2020-05-01   | D      |      182 |     0.004% |
| 596  | RMX1821          |                 |                           |                    |              | U      |      182 |     0.004% |
| 598  | odin             | Sony            | Xperia ZL                 | Snapdragon S4 Pro  | 2013-03-01   | D      |      181 |     0.004% |
| 598  | kagura           |                 |                           |                    |              | U      |      181 |     0.004% |
| 598  | ja3gxx           |                 |                           |                    |              | U      |      181 |     0.004% |
| 598  | X01BD            | ASUS            | Zenfone Max Pro M2        | Snapdragon 660     | 2018-12-01   | D      |      181 |     0.004% |
| 602  | meliusltexx      |                 |                           |                    |              | U      |      180 |     0.004% |
| 603  | js01lte          |                 |                           |                    |              | U      |      179 |     0.004% |
| 603  | crackling        | Wileyfox        | Swift                     | Snapdragon 410     | 2015-10-01   | D      |      179 |     0.004% |
| 605  | pme              | HTC             | HTC 10                    | Snapdragon 820     | 2016-05-01   | D      |      178 |     0.004% |
| 605  | goyavewifi       |                 |                           |                    |              | U      |      178 |     0.004% |
| 605  | elish            |                 |                           |                    |              | U      |      178 |     0.004% |
| 608  | z3s              |                 |                           |                    |              | U      |      176 |     0.004% |
| 609  | victara          | Motorola        | moto x (2014)             | Snapdragon 801     | 2014-09-26   | D      |      174 |     0.004% |
| 610  | n7000            |                 |                           |                    |              | U      |      173 |     0.004% |
| 610  | curtana          |                 |                           |                    |              | U      |      173 |     0.004% |
| 612  | yuga             | Sony            | Xperia Z                  | Snapdragon S4 Pro  | 2013-02-01   | D      |      172 |     0.004% |
| 612  | a32              |                 |                           |                    |              | U      |      172 |     0.004% |
| 614  | a5ultexx         |                 |                           |                    |              | U      |      171 |     0.004% |
| 615  | a05m             |                 |                           |                    |              | U      |      170 |     0.004% |
| 616  | chopin           |                 |                           |                    |              | U      |      169 |     0.004% |
| 617  | tundra           | Motorola        | edge 30 fusion            | Snapdragon 888+    | 2022-09-01   | O      |      168 |     0.004% |
| 618  | rodin            |                 |                           |                    |              | U      |      167 |     0.004% |
| 618  | j4corelte        |                 |                           |                    |              | U      |      167 |     0.004% |
| 620  | m21              |                 |                           |                    |              | U      |      166 |     0.004% |
| 620  | hima             |                 |                           |                    |              | U      |      166 |     0.004% |
| 622  | sake             | ASUS            | ZenFone 8                 | Snapdragon 888     | 2021-05-01   | O      |      165 |     0.004% |
| 622  | r5x              |                 |                           |                    |              | U      |      165 |     0.004% |
| 622  | j1acevelte       |                 |                           |                    |              | U      |      165 |     0.004% |
| 625  | t2s              |                 |                           |                    |              | U      |      164 |     0.004% |
| 626  | odroidc4         | HardKernel      | ODROID-C4 (Android TV)    | Amlogic S905X3     | 2020-12-01   | O      |      163 |     0.004% |
| 627  | b0q              |                 |                           |                    |              | U      |      162 |     0.004% |
| 628  | s3ve3g           |                 |                           |                    |              | U      |      160 |     0.004% |
| 628  | RMX1931          |                 |                           |                    |              | U      |      160 |     0.004% |
| 630  | poplar_dsds      |                 |                           |                    |              | U      |      159 |     0.004% |
| 631  | kltekdi          | Samsung         | Galaxy S5 LTE (SC-04F/SC… | Snapdragon 801     | 2014-05-01   | D      |      158 |     0.004% |
| 632  | vivalto3mveml3g  |                 |                           |                    |              | U      |      157 |     0.004% |
| 632  | ham              | ZUK             | Z1                        | Snapdragon 801     | 2015-10-14   | D      |      157 |     0.004% |
| 632  | gt58ltebmc       |                 |                           |                    |              | U      |      157 |     0.004% |
| 632  | f62              | Samsung         | Galaxy F62, Galaxy M62    | Exynos 9825        | 2021-02-22   | O      |      157 |     0.004% |
| 636  | gts7l            | Samsung         | Galaxy Tab S7 (LTE)       | Snapdragon 865+    | 2020-08-21   | O      |      155 |     0.004% |
| 637  | q2q              |                 |                           |                    |              | U      |      154 |     0.004% |
| 638  | karate           |                 |                           |                    |              | U      |      153 |     0.004% |
| 638  | TB8703N          |                 |                           |                    |              | U      |      153 |     0.004% |
| 640  | avalon           |                 |                           |                    |              | U      |      152 |     0.004% |
| 641  | ss2              |                 |                           |                    |              | U      |      151 |     0.004% |
| 641  | mermaid          | Sony            | Xperia 10 Plus            | Snapdragon 636     | 2019-02-01   | O      |      151 |     0.004% |
| 643  | quill            | NVIDIA          | Jetson TX2 [Android TV],… | Tegra X2 (T186)    | 2017-03-14   | O      |      150 |     0.003% |
| 643  | pro1x            | F(x)tec         | Pro¹ X                    | Snapdragon 662     | 2022-12-01   | O      |      150 |     0.003% |
| 645  | satsuki          |                 |                           |                    |              | U      |      149 |     0.003% |
| 646  | sweet2           |                 |                           |                    |              | U      |      148 |     0.003% |
| 646  | r7               |                 |                           |                    |              | U      |      148 |     0.003% |
| 648  | peregrine        | Motorola        | moto g 4G                 | Snapdragon 400     | 2014-06-01   | D      |      147 |     0.003% |
| 648  | Z1               |                 |                           |                    |              | U      |      147 |     0.003% |
| 650  | nuwa             | Xiaomi          | Xiaomi 13 Pro             | Snapdragon 8 Gen2  | 2022-12-11   | O      |      146 |     0.003% |
| 650  | f310p            |                 |                           |                    |              | U      |      146 |     0.003% |
| 652  | a34x             |                 |                           |                    |              | U      |      144 |     0.003% |
| 653  | kccat6           | Samsung         | Galaxy S5 Plus            | Snapdragon 805     | 2014-08-21   | D      |      143 |     0.003% |
| 653  | a9y18qlte        |                 |                           |                    |              | U      |      143 |     0.003% |
| 655  | a3ltexx          |                 |                           |                    |              | U      |      141 |     0.003% |
| 656  | lt02ltespr       | Samsung         | Galaxy Tab 3 7.0 LTE      | Snapdragon 400     | 2016-09-01   | D      |      140 |     0.003% |
| 656  | a21snsxx         |                 |                           |                    |              | U      |      140 |     0.003% |
| 658  | voyager          | Sony            | Xperia XA2 Plus           | Snapdragon 630     | 2018-07-01   | O      |      139 |     0.003% |
| 658  | nikel            |                 |                           |                    |              | U      |      139 |     0.003% |
| 658  | B2N              | Nokia           | Nokia 7 plus              | Snapdragon 660     | 2018-04-30   | O      |      139 |     0.003% |
| 661  | vili             |                 |                           |                    |              | U      |      138 |     0.003% |
| 661  | vermeer          |                 |                           |                    |              | U      |      138 |     0.003% |
| 661  | pdx237           | Sony            | Xperia 5 V                | Snapdragon 8 Gen2  | 2023-09-01   | O      |      138 |     0.003% |
| 661  | n5120            | Samsung         | Galaxy Note 8.0 (LTE)     | Exynos 4412        | 2013-04-01   | D      |      138 |     0.003% |
| 665  | beyond0          |                 |                           |                    |              | U      |      136 |     0.003% |
| 665  | RMX2020          |                 |                           |                    |              | U      |      136 |     0.003% |
| 665  | P350             |                 |                           |                    |              | U      |      136 |     0.003% |
| 668  | hannah           | Motorola        | moto e5 plus (XT1924-6/7… | Snapdragon 435     | 2018-05-01   | D      |      135 |     0.003% |
| 669  | r11s             |                 |                           |                    |              | U      |      133 |     0.003% |
| 669  | g0q              |                 |                           |                    |              | U      |      133 |     0.003% |
| 669  | a13              |                 |                           |                    |              | U      |      133 |     0.003% |
| 672  | unicorn          | Xiaomi          | Xiaomi 12S Pro            | Snapdragon 8+ Gen1 | 2022-07-04   | O      |      132 |     0.003% |
| 673  | jactivelte       | Samsung         | Galaxy S4 Active          | Snapdragon 600     | 2013-06-01   | D      |      131 |     0.003% |
| 673  | fire             |                 |                           |                    |              | U      |      131 |     0.003% |
| 673  | felix            | Google          | Pixel Fold                | Tensor GS201       | 2023-06-27   | O      |      131 |     0.003% |
| 676  | tapas            |                 |                           |                    |              | U      |      130 |     0.003% |
| 676  | redwood          |                 |                           |                    |              | U      |      130 |     0.003% |
| 676  | foster_tab       | NVIDIA          | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      130 |     0.003% |
| 676  | erhai            | OnePlus         | OnePlus Pad 2 Pro, OnePl… | Snapdragon 8 Elite | 2025-05-01   | O      |      130 |     0.003% |
| 680  | shark            | Xiaomi          | Black Shark               | Snapdragon 845     | 2018-04-01   | O      |      129 |     0.003% |
| 680  | marmite          |                 |                           |                    |              | U      |      129 |     0.003% |
| 680  | dandelion        |                 |                           |                    |              | U      |      129 |     0.003% |
| 683  | star2qltesq      |                 |                           |                    |              | U      |      128 |     0.003% |
| 683  | dopinder         | Walmart         | onn. TV Box 4K (2021)     | Amlogic S905Y2     | 2021-06-01   | O      |      128 |     0.003% |
| 685  | nx659j           | Nubia           | Red Magic 5G (Global), R… | Snapdragon 865     | 2020-03-01   | O      |      127 |     0.003% |
| 685  | gta2swifi        |                 |                           |                    |              | U      |      127 |     0.003% |
| 685  | albus            | Motorola        | moto z2 play              | Snapdragon 626     | 2017-06-01   | D      |      127 |     0.003% |
| 685  | TBX304F          |                 |                           |                    |              | U      |      127 |     0.003% |
| 689  | realme_trinket   |                 |                           |                    |              | U      |      126 |     0.003% |
| 689  | bahamut          |                 |                           |                    |              | U      |      126 |     0.003% |
| 691  | milanf           | Motorola        | moto g stylus 5G (2022)   | Snapdragon 695     | 2022-04-27   | O      |      125 |     0.003% |
| 692  | h850             | LG              | G5 (International)        | Snapdragon 820     | 2016-02-01   | D      |      124 |     0.003% |
| 693  | courbet          |                 |                           |                    |              | U      |      123 |     0.003% |
| 694  | RMX2001L1        |                 |                           |                    |              | U      |      122 |     0.003% |
| 695  | RMP6768          |                 |                           |                    |              | U      |      120 |     0.003% |
| 696  | P024             | ASUS            | ZenPad 8.0 (Z380KL)       | Snapdragon 410     | 2015-07-01   | D      |      118 |     0.003% |
| 696  | A10-70L          |                 |                           |                    |              | U      |      118 |     0.003% |
| 698  | r9q              |                 |                           |                    |              | U      |      117 |     0.003% |
| 698  | a42xq            |                 |                           |                    |              | U      |      117 |     0.003% |
| 700  | heart            | Lenovo          | Z5 Pro GT                 | Snapdragon 855     | 2019-01-29   | O      |      115 |     0.003% |
| 700  | RMX1851          | Realme          | Realme 3 Pro              | Snapdragon 710     | 2019-04-29   | D      |      115 |     0.003% |
| 702  | trlteduos        |                 |                           |                    |              | U      |      114 |     0.003% |
| 702  | trhpltexx        |                 |                           |                    |              | U      |      114 |     0.003% |
| 702  | debx             | Google          | Nexus 7 2013 (LTE, Repar… | Snapdragon S4 Pro  | 2013-07-26   | D      |      114 |     0.003% |
| 702  | bronco           | Motorola        | ThinkPhone by motorola    | Snapdragon 8+ Gen1 | 2023-01-01   | O      |      114 |     0.003% |
| 702  | beyond1q         |                 |                           |                    |              | U      |      114 |     0.003% |
| 702  | FP6              |                 |                           |                    |              | U      |      114 |     0.003% |
| 708  | toco             |                 |                           |                    |              | U      |      113 |     0.003% |
| 708  | lt01lte          |                 |                           |                    |              | U      |      113 |     0.003% |
| 708  | karin_windy      | Sony            | Xperia Z4 Tablet WiFi     | Snapdragon 810     | 2015-10-01   | D      |      113 |     0.003% |
| 708  | e3q              |                 |                           |                    |              | U      |      113 |     0.003% |
| 712  | g710n            | LG              | G7 ThinQ (G710N)          | Snapdragon 845     | 2018-05-02   | O      |      112 |     0.003% |
| 713  | oscar            | Realme          | Realme 9 Pro 5G, Realme … | Snapdragon 695     | 2022-02-23   | O      |      111 |     0.003% |
| 713  | karatep          |                 |                           |                    |              | U      |      111 |     0.003% |
| 713  | jackpotlte       |                 |                           |                    |              | U      |      111 |     0.003% |
| 713  | btvw09           |                 |                           |                    |              | U      |      111 |     0.003% |
| 713  | bouquet          |                 |                           |                    |              | U      |      111 |     0.003% |
| 718  | x86_64_tablet    |                 |                           |                    |              | U      |      110 |     0.003% |
| 718  | treble           |                 |                           |                    |              | U      |      110 |     0.003% |
| 718  | tb128fu          |                 |                           |                    |              | U      |      110 |     0.003% |
| 718  | ingot            | Solana          | Saga                      | Snapdragon 8+ Gen1 | 2023-05-01   | O      |      110 |     0.003% |
| 718  | h990             | LG              | V20 (Global)              | Snapdragon 820     | 2016-10-01   | D      |      110 |     0.003% |
| 718  | d1q              |                 |                           |                    |              | U      |      110 |     0.003% |
| 718  | a32x             |                 |                           |                    |              | U      |      110 |     0.003% |
| 718  | a23              |                 |                           |                    |              | U      |      110 |     0.003% |
| 718  | RMX1941          |                 |                           |                    |              | U      |      110 |     0.003% |
| 727  | ares             |                 |                           |                    |              | U      |      108 |     0.003% |
| 727  | a50              |                 |                           |                    |              | U      |      108 |     0.003% |
| 729  | gracelte         |                 |                           |                    |              | U      |      106 |     0.002% |
| 730  | i9152            |                 |                           |                    |              | U      |      105 |     0.002% |
| 730  | alice            |                 |                           |                    |              | U      |      105 |     0.002% |
| 730  | Onyx             |                 |                           |                    |              | U      |      105 |     0.002% |
| 733  | denver           | Motorola        | moto g stylus 5G          | Snapdragon 480     | 2021-06-14   | O      |      104 |     0.002% |
| 734  | h870             | LG              | G6 (EU Unlocked)          | Snapdragon 821     | 2017-02-01   | D      |      103 |     0.002% |
| 734  | fortunave3g      |                 |                           |                    |              | U      |      103 |     0.002% |
| 736  | yunluo           |                 |                           |                    |              | U      |      102 |     0.002% |
| 736  | m1971            |                 |                           |                    |              | U      |      102 |     0.002% |
| 736  | h918             | LG              | V20 (T-Mobile)            | Snapdragon 820     | 2016-10-01   | D      |      102 |     0.002% |
| 739  | viva             |                 |                           |                    |              | U      |      101 |     0.002% |
| 740  | xdplus           |                 |                           |                    |              | U      |      100 |     0.002% |
| 741  | i9105p           |                 |                           |                    |              | U      |       99 |     0.002% |
| 741  | huashan          | Sony            | Xperia SP                 | Snapdragon S4 Pro  | 2013-04-01   | D      |       99 |     0.002% |
| 741  | a13x             |                 |                           |                    |              | U      |       99 |     0.002% |
| 744  | p10bio           |                 |                           |                    |              | U      |       96 |     0.002% |
| 744  | b4q              |                 |                           |                    |              | U      |       96 |     0.002% |
| 744  | a20e             |                 |                           |                    |              | U      |       96 |     0.002% |
| 747  | j23g             |                 |                           |                    |              | U      |       95 |     0.002% |
| 747  | axolotl          | SHIFT           | SHIFT6mq                  | Snapdragon 845     | 2020-06-01   | O      |       95 |     0.002% |
| 747  | aurora           | Sony            | Xperia XZ2 Premium        | Snapdragon 845     | 2018-04-01   | O      |       95 |     0.002% |
| 747  | afyonltecan      |                 |                           |                    |              | U      |       95 |     0.002% |
| 751  | tetris           |                 |                           |                    |              | U      |       94 |     0.002% |
| 751  | jackpot2lte      |                 |                           |                    |              | U      |       94 |     0.002% |
| 753  | nashc            |                 |                           |                    |              | U      |       93 |     0.002% |
| 753  | X6833B           |                 |                           |                    |              | U      |       93 |     0.002% |
| 753  | X6531            |                 |                           |                    |              | U      |       93 |     0.002% |
| 753  | LH7n             |                 |                           |                    |              | U      |       93 |     0.002% |
| 757  | tank             |                 |                           |                    |              | U      |       92 |     0.002% |
| 758  | waydroid_kvadra… |                 |                           |                    |              | U      |       91 |     0.002% |
| 759  | rock             |                 |                           |                    |              | U      |       90 |     0.002% |
| 759  | odroidm1         |                 |                           |                    |              | U      |       90 |     0.002% |
| 759  | o7prolte         |                 |                           |                    |              | U      |       90 |     0.002% |
| 759  | gt58lte          |                 |                           |                    |              | U      |       90 |     0.002% |
| 759  | checkers         |                 |                           |                    |              | U      |       90 |     0.002% |
| 759  | berlna           | Motorola        | edge 2021                 | Snapdragon 778G 5G | 2021-08-19   | O      |       90 |     0.002% |
| 759  | a04e             |                 |                           |                    |              | U      |       90 |     0.002% |
| 759  | a03s             |                 |                           |                    |              | U      |       90 |     0.002% |
| 767  | nx551j           |                 |                           |                    |              | U      |       89 |     0.002% |
| 767  | m5               | Banana Pi       | M5 (Android TV)           | Amlogic S905X3     | 2020-12-01   | O      |       89 |     0.002% |
| 769  | frd              |                 |                           |                    |              | U      |       88 |     0.002% |
| 770  | a22x             |                 |                           |                    |              | U      |       87 |     0.002% |
| 770  | RMX1971          |                 |                           |                    |              | U      |       87 |     0.002% |
| 772  | pocket2          |                 |                           |                    |              | U      |       86 |     0.002% |
| 772  | oxford           |                 |                           |                    |              | U      |       86 |     0.002% |
| 772  | icosa_sr         |                 |                           |                    |              | U      |       86 |     0.002% |
| 772  | gts7xlwifi       |                 |                           |                    |              | U      |       86 |     0.002% |
| 776  | sphynx           |                 |                           |                    |              | U      |       85 |     0.002% |
| 776  | scorpio          | Xiaomi          | Mi Note 2                 | Snapdragon 821     | 2016-11-01   | D      |       85 |     0.002% |
| 776  | g710ulm          | LG              | G7 ThinQ (G710ULM/VMX)    | Snapdragon 845     | 2018-05-02   | O      |       85 |     0.002% |
| 776  | c1s              |                 |                           |                    |              | U      |       85 |     0.002% |
| 780  | waydroid_arm     |                 |                           |                    |              | U      |       84 |     0.002% |
| 780  | gale             |                 |                           |                    |              | U      |       84 |     0.002% |
| 780  | ether            | Nextbit         | Robin                     | Snapdragon 808     | 2016-02-01   | D      |       84 |     0.002% |
| 780  | cruiserltesq     |                 |                           |                    |              | U      |       84 |     0.002% |
| 780  | Crystal          |                 |                           |                    |              | U      |       84 |     0.002% |
| 785  | mayfly           | Xiaomi          | Xiaomi 12S                | Snapdragon 8+ Gen1 | 2022-07-01   | O      |       83 |     0.002% |
| 785  | lithium          | Xiaomi          | Mi MIX                    | Snapdragon 821     | 2016-10-01   | D      |       83 |     0.002% |
| 785  | lime             |                 |                           |                    |              | U      |       83 |     0.002% |
| 785  | a10dd            |                 |                           |                    |              | U      |       83 |     0.002% |
| 789  | mojito           |                 |                           |                    |              | U      |       82 |     0.002% |
| 789  | j7eltexx         |                 |                           |                    |              | U      |       82 |     0.002% |
| 789  | dora             |                 |                           |                    |              | U      |       82 |     0.002% |
| 789  | X01AD            | ASUS            | Zenfone Max M2            | Snapdragon 632     | 2018-12-01   | D      |       82 |     0.002% |
| 793  | h910             | LG              | V20 (AT&T)                | Snapdragon 820     | 2016-10-01   | D      |       81 |     0.002% |
| 794  | wt88047x         |                 |                           |                    |              | U      |       80 |     0.002% |
| 794  | samurai          |                 |                           |                    |              | U      |       80 |     0.002% |
| 794  | q4q              |                 |                           |                    |              | U      |       80 |     0.002% |
| 794  | axon7            | ZTE             | Axon 7                    | Snapdragon 820     | 2016-06-01   | D      |       80 |     0.002% |
| 798  | olivelite        |                 |                           |                    |              | U      |       79 |     0.002% |
| 798  | odessa           |                 |                           |                    |              | U      |       79 |     0.002% |
| 798  | greatqlte        |                 |                           |                    |              | U      |       79 |     0.002% |
| 798  | a31              |                 |                           |                    |              | U      |       79 |     0.002% |
| 802  | x55              |                 |                           |                    |              | U      |       78 |     0.002% |
| 802  | m307f            |                 |                           |                    |              | U      |       78 |     0.002% |
| 802  | X6739            |                 |                           |                    |              | U      |       78 |     0.002% |
| 802  | RMX1801          | Realme          | Realme 2 Pro              | Snapdragon 660     | 2018-10-11   | D      |       78 |     0.002% |
| 806  | mars             | Xiaomi          | Mi 11 Pro                 | Snapdragon 888     | 2021-03-01   | D      |       77 |     0.002% |
| 806  | m31s             |                 |                           |                    |              | U      |       77 |     0.002% |
| 808  | olives           |                 |                           |                    |              | U      |       75 |     0.002% |
| 809  | wt89536          |                 |                           |                    |              | U      |       74 |     0.002% |
| 809  | wade             | Dynalink        | TV Box 4K (2021)          | Amlogic S905Y2     | 2021-06-01   | O      |       74 |     0.002% |
| 809  | tate             |                 |                           |                    |              | U      |       74 |     0.002% |
| 809  | porg             | NVIDIA          | Jetson Nano [Android TV]… | Tegra X1 (T210)    | 2019-03-18   | O      |       74 |     0.002% |
| 809  | ferrari          |                 |                           |                    |              | U      |       74 |     0.002% |
| 809  | Pacman           |                 |                           |                    |              | U      |       74 |     0.002% |
| 815  | tilapia          |                 |                           |                    |              | U      |       73 |     0.002% |
| 815  | nora             |                 |                           |                    |              | U      |       73 |     0.002% |
| 815  | Dragon           |                 |                           |                    |              | U      |       73 |     0.002% |
| 815  | A6020            | Lenovo          | Vibe K5, Vibe K5 Plus     | Snapdragon 415     | 2016-04-01   | D      |       73 |     0.002% |
| 819  | starqltesq       |                 |                           |                    |              | U      |       72 |     0.002% |
| 819  | judyp            | LG              | V35 ThinQ                 | Snapdragon 845     | 2018-05-30   | O      |       72 |     0.002% |
| 819  | casuarina        | Vsmart          | Joy 3, Joy 3+             | Snapdragon 632     | 2020-02-14   | O      |       72 |     0.002% |
| 819  | a6plte           |                 |                           |                    |              | U      |       72 |     0.002% |
| 823  | sweet_k6a        |                 |                           |                    |              | U      |       71 |     0.002% |
| 823  | perry            |                 |                           |                    |              | U      |       71 |     0.002% |
| 823  | m51              |                 |                           |                    |              | U      |       71 |     0.002% |
| 823  | kyleprods        |                 |                           |                    |              | U      |       71 |     0.002% |
| 823  | cuscoi           |                 |                           |                    |              | U      |       71 |     0.002% |
| 823  | bitra            |                 |                           |                    |              | U      |       71 |     0.002% |
| 823  | a30s             |                 |                           |                    |              | U      |       71 |     0.002% |
| 830  | pdx201           |                 |                           |                    |              | U      |       70 |     0.002% |
| 830  | kingdom          | Lenovo          | Vibe Z2 Pro               | Snapdragon 801     | 2014-09-01   | D      |       70 |     0.002% |
| 830  | everpal          |                 |                           |                    |              | U      |       70 |     0.002% |
| 830  | citrus           |                 |                           |                    |              | U      |       70 |     0.002% |
| 830  | asteroids        |                 |                           |                    |              | U      |       70 |     0.002% |
| 830  | a04              |                 |                           |                    |              | U      |       70 |     0.002% |
| 836  | condor           | Motorola        | moto e                    | Snapdragon 200     | 2014-05-13   | D      |       69 |     0.002% |
| 836  | aio_otfp         |                 |                           |                    |              | U      |       69 |     0.002% |
| 836  | GM9PRO_sprout    |                 |                           |                    |              | U      |       69 |     0.002% |
| 839  | r5q              |                 |                           |                    |              | U      |       68 |     0.002% |
| 839  | j1x3gxx          |                 |                           |                    |              | U      |       68 |     0.002% |
| 839  | Daredevil        |                 |                           |                    |              | U      |       68 |     0.002% |
| 842  | ruby             |                 |                           |                    |              | U      |       67 |     0.002% |
| 842  | p6800            |                 |                           |                    |              | U      |       67 |     0.002% |
| 842  | klteactivexx     | Samsung         | Galaxy S5 Active (G870F)  | Snapdragon 801     | 2014-12-01   | D      |       67 |     0.002% |
| 842  | h3gduoschn       |                 |                           |                    |              | U      |       67 |     0.002% |
| 842  | f300             |                 |                           |                    |              | U      |       67 |     0.002% |
| 842  | a24              |                 |                           |                    |              | U      |       67 |     0.002% |
| 848  | gprimeltexx      |                 |                           |                    |              | U      |       66 |     0.002% |
| 848  | eqs              | Motorola        | edge 30 ultra             | Snapdragon 8+ Gen1 | 2022-09-01   | O      |       66 |     0.002% |
| 848  | e1s              |                 |                           |                    |              | U      |       66 |     0.002% |
| 848  | chuwi_vi10plus   |                 |                           |                    |              | U      |       66 |     0.002% |
| 848  | RMX1911          |                 |                           |                    |              | U      |       66 |     0.002% |
| 853  | nx595j           |                 |                           |                    |              | U      |       65 |     0.002% |
| 853  | nx569j           |                 |                           |                    |              | U      |       65 |     0.002% |
| 853  | nobleltejv       |                 |                           |                    |              | U      |       65 |     0.002% |
| 853  | le_x620          |                 |                           |                    |              | U      |       65 |     0.002% |
| 853  | j1mini3gxw       |                 |                           |                    |              | U      |       65 |     0.002% |
| 853  | h830             | LG              | G5 (T-Mobile)             | Snapdragon 820     | 2016-02-01   | D      |       65 |     0.002% |
| 853  | cupidr           |                 |                           |                    |              | U      |       65 |     0.002% |
| 853  | A001D            |                 |                           |                    |              | U      |       65 |     0.002% |
| 861  | k3gxx            | Samsung         | Galaxy S5 (International… | Exynos 5422        | 2014-03-01   | D      |       64 |     0.001% |
| 861  | gunnar           | OnePlus         | OnePlus Nord N20          | Snapdragon 695     | 2022-04-28   | O      |       64 |     0.001% |
| 861  | dream2qltesq     |                 |                           |                    |              | U      |       64 |     0.001% |
| 861  | comet            | Google          | Pixel 9 Pro Fold          | Tensor G4          | 2024-09-04   | O      |       64 |     0.001% |
| 865  | beyond2          |                 |                           |                    |              | U      |       63 |     0.001% |
| 865  | Z00xD            |                 |                           |                    |              | U      |       63 |     0.001% |
| 867  | zorn             |                 |                           |                    |              | U      |       62 |     0.001% |
| 867  | zippo            | Lenovo          | Z6 Pro                    | Snapdragon 855     | 2019-09-11   | O      |       62 |     0.001% |
| 867  | on5ltetmo        |                 |                           |                    |              | U      |       62 |     0.001% |
| 867  | nx611j           | Nubia           | Z18 Mini                  | Snapdragon 660     | 2018-04-01   | O      |       62 |     0.001% |
| 867  | liber            | Motorola        | one fusion+, one fusion+… | Snapdragon 730     | 2020-06-01   | D      |       62 |     0.001% |
| 867  | corfur           |                 |                           |                    |              | U      |       62 |     0.001% |
| 867  | clark            | Motorola        | moto x pure edition (201… | Snapdragon 808     | 2015-09-01   | D      |       62 |     0.001% |
| 867  | RMX2030          |                 |                           |                    |              | U      |       62 |     0.001% |
| 875  | thea             | Motorola        | moto g LTE (2014)         | Snapdragon 400     | 2015-01-01   | D      |       61 |     0.001% |
| 875  | nx523j           |                 |                           |                    |              | U      |       61 |     0.001% |
| 875  | kmini3g          |                 |                           |                    |              | U      |       61 |     0.001% |
| 875  | ghost            | Motorola        | moto x                    | Snapdragon S4 Pro  | 2013-08-23   | D      |       61 |     0.001% |
| 875  | benz             | OnePlus         | OnePlus Nord CE4          | Snapdragon 7 Gen 3 | 2024-04-01   | O      |       61 |     0.001% |
| 880  | maguro           | Google          | Galaxy Nexus GSM          | OMAP 4460          | 2011-10-01   | D      |       60 |     0.001% |
| 880  | andromeda        |                 |                           |                    |              | U      |       60 |     0.001% |
| 880  | a6000            |                 |                           |                    |              | U      |       60 |     0.001% |
| 880  | 2027             |                 |                           |                    |              | U      |       60 |     0.001% |
| 884  | hllte            |                 |                           |                    |              | U      |       59 |     0.001% |
| 884  | 2036             |                 |                           |                    |              | U      |       59 |     0.001% |
| 886  | quark            |                 |                           |                    |              | U      |       58 |     0.001% |
| 886  | lunaa            |                 |                           |                    |              | U      |       58 |     0.001% |
| 886  | hl3g             |                 |                           |                    |              | U      |       58 |     0.001% |
| 886  | g0s              |                 |                           |                    |              | U      |       58 |     0.001% |
| 890  | pissarro         |                 |                           |                    |              | U      |       57 |     0.001% |
| 890  | olive            |                 |                           |                    |              | U      |       57 |     0.001% |
| 890  | amogus_doha      |                 |                           |                    |              | U      |       57 |     0.001% |
| 890  | a25x             |                 |                           |                    |              | U      |       57 |     0.001% |
| 890  | a20s             |                 |                           |                    |              | U      |       57 |     0.001% |
| 890  | RMX2151L1        |                 |                           |                    |              | U      |       57 |     0.001% |
| 890  | PNX_sprout       |                 |                           |                    |              | U      |       57 |     0.001% |
| 897  | me173x           |                 |                           |                    |              | U      |       56 |     0.001% |
| 897  | enzo             |                 |                           |                    |              | U      |       56 |     0.001% |
| 899  | tiare            |                 |                           |                    |              | U      |       55 |     0.001% |
| 899  | star2qltecs      |                 |                           |                    |              | U      |       55 |     0.001% |
| 899  | j7duolte         |                 |                           |                    |              | U      |       55 |     0.001% |
| 899  | h815             | LG              | G4 (International)        | Snapdragon 808     | 2015-06-01   | D      |       55 |     0.001% |
| 903  | picasso          |                 |                           |                    |              | U      |       54 |     0.001% |
| 903  | m14x             |                 |                           |                    |              | U      |       54 |     0.001% |
| 903  | lentislte        | Samsung         | Galaxy S5 LTE-A           | Snapdragon 805     | 2014-07-15   | D      |       54 |     0.001% |
| 903  | klimtdcm         |                 |                           |                    |              | U      |       54 |     0.001% |
| 903  | P661N            |                 |                           |                    |              | U      |       54 |     0.001% |
| 908  | r0q              |                 |                           |                    |              | U      |       53 |     0.001% |
| 908  | jfltespr         | Samsung         | Galaxy S4 (SCH-R970, SPH… | Snapdragon 600     | 2013-04-01   | D      |       53 |     0.001% |
| 908  | hennessy         |                 |                           |                    |              | U      |       53 |     0.001% |
| 908  | betalm           | LG              | G8s ThinQ                 | Snapdragon 855     | 2019-06-01   | O      |       53 |     0.001% |
| 908  | TB8504F          |                 |                           |                    |              | U      |       53 |     0.001% |
| 913  | y2q              |                 |                           |                    |              | U      |       52 |     0.001% |
| 913  | pro1             | F(x)tec         | Pro¹                      | Snapdragon 835     | 2019-10-01   | O      |       52 |     0.001% |
| 913  | pearl            |                 |                           |                    |              | U      |       52 |     0.001% |
| 913  | jd2019           |                 |                           |                    |              | U      |       52 |     0.001% |
| 913  | james            |                 |                           |                    |              | U      |       52 |     0.001% |
| 913  | a16              |                 |                           |                    |              | U      |       52 |     0.001% |
| 913  | TB2X30L          |                 |                           |                    |              | U      |       52 |     0.001% |
| 920  | ks01lte          | Samsung         | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | D      |       51 |     0.001% |
| 920  | caihong          |                 |                           |                    |              | U      |       51 |     0.001% |
| 920  | a13ve            |                 |                           |                    |              | U      |       51 |     0.001% |
| 920  | TB3710F          |                 |                           |                    |              | U      |       51 |     0.001% |
| 920  | MT6893           |                 |                           |                    |              | U      |       51 |     0.001% |
| 925  | ursa             | Xiaomi          | Mi 8 Explorer Edition     | Snapdragon 845     | 2018-07-01   | O      |       50 |     0.001% |
| 925  | a5y17ltecan      |                 |                           |                    |              | U      |       50 |     0.001% |
| 925  | OP4F2F           |                 |                           |                    |              | U      |       50 |     0.001% |
| 928  | kltechn          | Samsung         | Galaxy S5 LTE (G9006V/8V) | Snapdragon 801     | 2014-04-01   | D      |       49 |     0.001% |
| 928  | X3               |                 |                           |                    |              | U      |       49 |     0.001% |
| 930  | r0s              |                 |                           |                    |              | U      |       48 |     0.001% |
| 930  | ef63             |                 |                           |                    |              | U      |       48 |     0.001% |
| 932  | eagle            |                 |                           |                    |              | U      |       47 |     0.001% |
| 932  | breeze           |                 |                           |                    |              | U      |       47 |     0.001% |
| 932  | Z00T             | ASUS            | Zenfone 2 Laser (1080p),… | Snapdragon 615     | 2015-11-01   | D      |       47 |     0.001% |
| 935  | sltexx           |                 |                           |                    |              | U      |       46 |     0.001% |
| 935  | find7            | OPPO            | Find 7a, Find 7s          | Snapdragon 801     | 2014-03-19   | D      |       46 |     0.001% |
| 935  | eyeul            |                 |                           |                    |              | U      |       46 |     0.001% |
| 938  | zeekr            |                 |                           |                    |              | U      |       45 |     0.001% |
| 938  | star             |                 |                           |                    |              | U      |       45 |     0.001% |
| 938  | rhannah          | Motorola        | moto e5 plus (XT1924-1/2… | Snapdragon 425     | 2018-05-01   | D      |       45 |     0.001% |
| 938  | logan2g          |                 |                           |                    |              | U      |       45 |     0.001% |
| 938  | dreamqlteue      |                 |                           |                    |              | U      |       45 |     0.001% |
| 938  | a14x             |                 |                           |                    |              | U      |       45 |     0.001% |
| 944  | us996            | LG              | V20 (GSM Unlocked)        | Snapdragon 820     | 2016-10-01   | D      |       44 |     0.001% |
| 944  | r1q              |                 |                           |                    |              | U      |       44 |     0.001% |
| 944  | mediapadm5lte    |                 |                           |                    |              | U      |       44 |     0.001% |
| 944  | m01q             |                 |                           |                    |              | U      |       44 |     0.001% |
| 944  | halo             |                 |                           |                    |              | U      |       44 |     0.001% |
| 944  | bloomq           |                 |                           |                    |              | U      |       44 |     0.001% |
| 944  | a10s             |                 |                           |                    |              | U      |       44 |     0.001% |
| 951  | z3q              |                 |                           |                    |              | U      |       43 |     0.001% |
| 951  | t6               | HTC             | One Max (GSM)             | Snapdragon 600     | 2013-10-01   | D      |       43 |     0.001% |
| 951  | gprimelte        |                 |                           |                    |              | U      |       43 |     0.001% |
| 951  | RMX2001          |                 |                           |                    |              | U      |       43 |     0.001% |
| 955  | star2lteks       |                 |                           |                    |              | U      |       42 |    0.0010% |
| 955  | radxa0           | Radxa           | Zero (Android TV)         | Amlogic S905Y2     | 2020-12-01   | O      |       42 |    0.0010% |
| 955  | loganreltexx     |                 |                           |                    |              | U      |       42 |    0.0010% |
| 955  | PAN_sprout       |                 |                           |                    |              | U      |       42 |    0.0010% |
| 955  | 2026             |                 |                           |                    |              | U      |       42 |    0.0010% |
| 960  | ziti             |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | zangyapro        | BQ              | Aquaris X2 Pro            | Snapdragon 626     | 2017-06-01   | D      |       41 |    0.0010% |
| 960  | vs995            | LG              | V20 (Verizon)             | Snapdragon 820     | 2016-10-01   | D      |       41 |    0.0010% |
| 960  | vns              |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | starqltecs       |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | rubens           |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | psyche           |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | Z00A             | ASUS            | Zenfone 2 (1080p)         | Atom Z3580         | 2015-03-01   | D      |       41 |    0.0010% |
| 960  | RMX3852          |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | RMX1805          |                 |                           |                    |              | U      |       41 |    0.0010% |
| 960  | Amber            | Yandex          | Phone                     | Snapdragon 630     | 2018-12-01   | D      |       41 |    0.0010% |
| 971  | memul            |                 |                           |                    |              | U      |       40 |    0.0009% |
| 971  | kylepro          |                 |                           |                    |              | U      |       40 |    0.0009% |
| 971  | charlotte        | Huawei          | P20 Pro                   | Kirin 970          | 2018-04-01   | D      |       40 |    0.0009% |
| 971  | OP4863           |                 |                           |                    |              | U      |       40 |    0.0009% |
| 975  | zizhan           | Xiaomi          | MIX Fold 2                | Snapdragon 8+ Gen1 | 2022-08-11   | O      |       39 |    0.0009% |
| 975  | zerofltecan      |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | star2qlteue      |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | malachite        |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | j2xlte           |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | fde_x86_64       |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | dream2qlteue     |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | corot            |                 |                           |                    |              | U      |       39 |    0.0009% |
| 975  | TB3-850M         |                 |                           |                    |              | U      |       39 |    0.0009% |
| 984  | m30lte           |                 |                           |                    |              | U      |       38 |    0.0009% |
| 984  | greatqlteue      |                 |                           |                    |              | U      |       38 |    0.0009% |
| 984  | e8               |                 |                           |                    |              | U      |       38 |    0.0009% |
| 984  | denniz           |                 |                           |                    |              | U      |       38 |    0.0009% |
| 984  | 1951             |                 |                           |                    |              | U      |       38 |    0.0009% |
| 984  | 1907             |                 |                           |                    |              | U      |       38 |    0.0009% |
| 990  | vela             | Xiaomi          | Mi CC9 Meitu Edition      | Snapdragon 710     | 2019-09-01   | O      |       37 |    0.0009% |
| 990  | taoyao           |                 |                           |                    |              | U      |       37 |    0.0009% |
| 990  | paella           | BQ              | Aquaris X5                | Snapdragon 412     | 2015-10-14   | D      |       37 |    0.0009% |
| 990  | kltedcmactive    |                 |                           |                    |              | U      |       37 |    0.0009% |
| 990  | e8d              |                 |                           |                    |              | U      |       37 |    0.0009% |
| 990  | dm2q             |                 |                           |                    |              | U      |       37 |    0.0009% |
| 990  | cezanne          |                 |                           |                    |              | U      |       37 |    0.0009% |
| 990  | Z500             |                 |                           |                    |              | U      |       37 |    0.0009% |
| 990  | X00P             | ASUS            | Zenfone Max M1            | Snapdragon 430     | 2018-12-01   | D      |       37 |    0.0009% |
| 999  | smi              |                 |                           |                    |              | U      |       36 |    0.0008% |
| 999  | m307fn           |                 |                           |                    |              | U      |       36 |    0.0008% |
| 999  | d2att            | Samsung         | Galaxy S III (AT&T)       | Snapdragon S4 Plus | 2012-06-28   | D      |       36 |    0.0008% |
| 999  | androidbox       |                 |                           |                    |              | U      |       36 |    0.0008% |
| 999  | T00F             |                 |                           |                    |              | U      |       36 |    0.0008% |
| 999  | 1920             |                 |                           |                    |              | U      |       36 |    0.0008% |
| 1005 | venice           |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | mi439            |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | l01k             | LG              | V30 (Japan)               | Snapdragon 835     | 2017-08-01   | O      |       35 |    0.0008% |
| 1005 | dreamqltecan     |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | beryl            |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | a5dwg            |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | a3xeltexx        |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | OP4EFDL1         |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1005 | ASUS_X00AD_2     |                 |                           |                    |              | U      |       35 |    0.0008% |
| 1014 | rubyx            |                 |                           |                    |              | U      |       34 |    0.0008% |
| 1014 | dream2qltecan    |                 |                           |                    |              | U      |       34 |    0.0008% |
| 1014 | a5y17ltelgt      |                 |                           |                    |              | U      |       34 |    0.0008% |
| 1014 | OP4B79L1         |                 |                           |                    |              | U      |       34 |    0.0008% |
| 1018 | x3               |                 |                           |                    |              | U      |       33 |    0.0008% |
| 1018 | m2note           |                 |                           |                    |              | U      |       33 |    0.0008% |
| 1018 | hi6250           |                 |                           |                    |              | U      |       33 |    0.0008% |
| 1018 | delos3geur       |                 |                           |                    |              | U      |       33 |    0.0008% |
| 1018 | Z00L             | ASUS            | Zenfone 2 Laser (720p)    | Snapdragon 410     | 2015-11-01   | D      |       33 |    0.0008% |
| 1023 | winner           |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1023 | pele             |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1023 | ms01lte          |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1023 | ivy              | Sony            | Xperia Z3+                | Snapdragon 810     | 2015-06-01   | D      |       32 |    0.0007% |
| 1023 | hiae             | HTC             | One A9                    | Snapdragon 617     | 2015-10-20   | D      |       32 |    0.0007% |
| 1023 | hero2ltektt      |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1023 | d2spr            | Samsung         | Galaxy S III (Sprint)     | Snapdragon S4 Plus | 2012-06-28   | D      |       32 |    0.0007% |
| 1023 | certus64         |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1023 | a3core           |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1023 | 2025             |                 |                           |                    |              | U      |       32 |    0.0007% |
| 1033 | porsche          |                 |                           |                    |              | U      |       31 |    0.0007% |
| 1033 | parker           | Motorola        | one zoom                  | Snapdragon 675     | 2019-09-05   | D      |       31 |    0.0007% |
| 1033 | nobleltezt       |                 |                           |                    |              | U      |       31 |    0.0007% |
| 1033 | m33x             |                 |                           |                    |              | U      |       31 |    0.0007% |
| 1033 | c2q              |                 |                           |                    |              | U      |       31 |    0.0007% |
| 1033 | K2               |                 |                           |                    |              | U      |       31 |    0.0007% |
| 1039 | z2_row           |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | wt86528          |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | w7               | LG              | L90                       | Snapdragon 400     | 2014-02-01   | D      |       30 |    0.0007% |
| 1039 | ulova            |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | spartan          |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | scale            |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | nx606j           | Nubia           | Z18                       | Snapdragon 845     | 2018-09-01   | O      |       30 |    0.0007% |
| 1039 | m53x             |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | gts7xl           |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | ef60             |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | ef59             |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | bathena          | Motorola        | defy 2021                 | Snapdragon 662     | 2021-06-01   | O      |       30 |    0.0007% |
| 1039 | atom             |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1039 | a82xq            |                 |                           |                    |              | U      |       30 |    0.0007% |
| 1053 | nx591j           |                 |                           |                    |              | U      |       29 |    0.0007% |
| 1053 | j5xnltexx        |                 |                           |                    |              | U      |       29 |    0.0007% |
| 1053 | h872             | LG              | G6 (T-Mobile)             | Snapdragon 821     | 2017-02-01   | D      |       29 |    0.0007% |
| 1053 | a5y17lteskt      |                 |                           |                    |              | U      |       29 |    0.0007% |
| 1053 | a23xq            |                 |                           |                    |              | U      |       29 |    0.0007% |
| 1053 | OP4C51L1         |                 |                           |                    |              | U      |       29 |    0.0007% |
| 1053 | OP4BA5L1         |                 |                           |                    |              | U      |       29 |    0.0007% |
| 1060 | g2m              | LG              | G2 Mini                   | Snapdragon 400     | 2014-04-01   | D      |       28 |    0.0007% |
| 1060 | dream2lteks      |                 |                           |                    |              | U      |       28 |    0.0007% |
| 1060 | a5ul             |                 |                           |                    |              | U      |       28 |    0.0007% |
| 1063 | zircon           |                 |                           |                    |              | U      |       27 |    0.0006% |
| 1063 | jag3gds          | LG              | G3 S                      | Snapdragon 400     | 2014-08-01   | D      |       27 |    0.0006% |
| 1063 | e1q              |                 |                           |                    |              | U      |       27 |    0.0006% |
| 1066 | us996d           | LG              | V20 (GSM Unlocked - Dirt… | Snapdragon 820     | 2016-10-01   | D      |       26 |    0.0006% |
| 1066 | tiro             |                 |                           |                    |              | U      |       26 |    0.0006% |
| 1066 | sydneym          |                 |                           |                    |              | U      |       26 |    0.0006% |
| 1066 | sirisu           |                 |                           |                    |              | U      |       26 |    0.0006% |
| 1066 | nx619j           | Nubia           | Red Magic Mars            | Snapdragon 845     | 2018-12-01   | O      |       26 |    0.0006% |
| 1066 | emerald          |                 |                           |                    |              | U      |       26 |    0.0006% |
| 1066 | alphalm          |                 |                           |                    |              | U      |       26 |    0.0006% |
| 1066 | F1               |                 |                           |                    |              | U      |       26 |    0.0006% |
| 1074 | x6833b           |                 |                           |                    |              | U      |       25 |    0.0006% |
| 1074 | fortunafz        |                 |                           |                    |              | U      |       25 |    0.0006% |
| 1076 | lexus            |                 |                           |                    |              | U      |       24 |    0.0006% |
| 1076 | juice            |                 |                           |                    |              | U      |       24 |    0.0006% |
| 1076 | a55x             |                 |                           |                    |              | U      |       24 |    0.0006% |
| 1076 | OP46B1           |                 |                           |                    |              | U      |       24 |    0.0006% |
| 1080 | ziyi             |                 |                           |                    |              | U      |       23 |    0.0005% |
| 1080 | tenet            |                 |                           |                    |              | U      |       23 |    0.0005% |
| 1080 | houji            |                 |                           |                    |              | U      |       23 |    0.0005% |
| 1080 | dogo             | Sony            | Xperia ZR                 | Snapdragon S4 Pro  | 2013-06-01   | D      |       23 |    0.0005% |
| 1080 | chef             | Motorola        | one power                 | Snapdragon 636     | 2018-10-10   | D      |       23 |    0.0005% |
| 1085 | shamrock         |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | penang           |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | passion          |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | kltedcm          |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | j5ltechn         |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | e53g             |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | X00I             |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1085 | CK8n             |                 |                           |                    |              | U      |       22 |    0.0005% |
| 1093 | r7sf             | OPPO            | R7s (International)       | Snapdragon 615     | 2015-11-01   | D      |       21 |    0.0005% |
| 1093 | jagnm            | LG              | G3 Beat                   | Snapdragon 400     | 2014-08-01   | D      |       21 |    0.0005% |
| 1093 | arubaslim        |                 |                           |                    |              | U      |       21 |    0.0005% |
| 1093 | X00H             |                 |                           |                    |              | U      |       21 |    0.0005% |
| 1097 | poplar_kddi      |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1097 | paros            |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1097 | owens            |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1097 | nobleltetmo      |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1097 | klteaio          | Samsung         | Galaxy S5 LTE (G900AZ/S9… | Snapdragon 801     | 2014-04-11   | D      |       20 |    0.0005% |
| 1097 | c1q              |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1097 | amber            |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1097 | X6532            |                 |                           |                    |              | U      |       20 |    0.0005% |
| 1105 | wly              |                 |                           |                    |              | U      |       19 |    0.0004% |
| 1105 | kltechnduo       | Samsung         | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-04-01   | D      |       19 |    0.0004% |
| 1105 | himaul           | HTC             | One M9 (GSM)              | Snapdragon 810     | 2015-03-01   | D      |       19 |    0.0004% |
| 1105 | fortunalteub     |                 |                           |                    |              | U      |       19 |    0.0004% |
| 1105 | f1f              | OPPO            | F1 (International)        | Snapdragon 615     | 2016-01-01   | D      |       19 |    0.0004% |
| 1105 | ebba             |                 |                           |                    |              | U      |       19 |    0.0004% |
| 1105 | apollopro        |                 |                           |                    |              | U      |       19 |    0.0004% |
| 1105 | KL5              |                 |                           |                    |              | U      |       19 |    0.0004% |
| 1105 | KJ5              |                 |                           |                    |              | U      |       19 |    0.0004% |
| 1114 | udon             |                 |                           |                    |              | U      |       18 |    0.0004% |
| 1114 | piccolo          | BQ              | Aquaris M5                | Snapdragon 615     | 2015-08-01   | D      |       18 |    0.0004% |
| 1114 | m8d              | HTC             | One (M8) Dual SIM         | Snapdragon 801     | 2014-06-01   | D      |       18 |    0.0004% |
| 1117 | ulysse           |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | tsubasa          | Sony            | Xperia V                  | Snapdragon S4      | 2012-09-01   | D      |       17 |    0.0004% |
| 1117 | serranoltespr    |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | odroidgo3        |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | lv517            |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | j5ltekx          |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | h96_max_x3       |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | h815_usu         |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1117 | cs02             |                 |                           |                    |              | U      |       17 |    0.0004% |
| 1126 | zangya           | BQ              | Aquaris X2                | Snapdragon 636     | 2018-05-01   | D      |       16 |    0.0004% |
| 1126 | rio              |                 |                           |                    |              | U      |       16 |    0.0004% |
| 1126 | ph2n             |                 |                           |                    |              | U      |       16 |    0.0004% |
| 1126 | hayabusa         | Sony            | Xperia TX                 | Snapdragon S4      | 2012-08-01   | D      |       16 |    0.0004% |
| 1126 | figo             | Huawei          | P Smart                   | Kirin 659          | 2017-12-01   | D      |       16 |    0.0004% |
| 1126 | eqe              |                 |                           |                    |              | U      |       16 |    0.0004% |
| 1126 | a70s             |                 |                           |                    |              | U      |       16 |    0.0004% |
| 1126 | X6871            |                 |                           |                    |              | U      |       16 |    0.0004% |
| 1134 | vitamin          |                 |                           |                    |              | U      |       15 |    0.0003% |
| 1134 | tbelteskt        |                 |                           |                    |              | U      |       15 |    0.0003% |
| 1134 | a7lte            |                 |                           |                    |              | U      |       15 |    0.0003% |
| 1137 | willow           |                 |                           |                    |              | U      |       14 |    0.0003% |
| 1137 | nx609j           | Nubia           | Red Magic                 | Snapdragon 835     | 2018-04-01   | D      |       14 |    0.0003% |
| 1137 | nicki            | Sony            | Xperia M                  | Snapdragon S4 Plus | 2013-06-01   | D      |       14 |    0.0003% |
| 1137 | mint             | Sony            | Xperia T                  | Snapdragon S4      | 2012-09-01   | D      |       14 |    0.0003% |
| 1137 | gohan            | BQ              | Aquaris X5 Plus           | Snapdragon 652     | 2016-07-01   | D      |       14 |    0.0003% |
| 1142 | r7plus           | OPPO            | R7 Plus (International)   | Snapdragon 615     | 2015-05-01   | D      |       13 |    0.0003% |
| 1142 | prague           |                 |                           |                    |              | U      |       13 |    0.0003% |
| 1142 | plato            |                 |                           |                    |              | U      |       13 |    0.0003% |
| 1142 | j3xltebmc        |                 |                           |                    |              | U      |       13 |    0.0003% |
| 1142 | h812_usu         |                 |                           |                    |              | U      |       13 |    0.0003% |
| 1142 | anne             | Huawei          | P20 Lite                  | Kirin 659          | 2018-03-01   | D      |       13 |    0.0003% |
| 1142 | P1m              |                 |                           |                    |              | U      |       13 |    0.0003% |
| 1149 | z3dual           |                 |                           |                    |              | U      |       12 |    0.0003% |
| 1149 | w5               | LG              | Optimus L70               | Snapdragon 200     | 2014-04-01   | D      |       12 |    0.0003% |
| 1149 | s3_h560          |                 |                           |                    |              | U      |       12 |    0.0003% |
| 1149 | kltevzw          |                 |                           |                    |              | U      |       12 |    0.0003% |
| 1149 | j7xlte           |                 |                           |                    |              | U      |       12 |    0.0003% |
| 1149 | d852             | LG              | G3 (Canada)               | Snapdragon 801     | 2014-06-01   | D      |       12 |    0.0003% |
| 1149 | crownqltechn     |                 |                           |                    |              | U      |       12 |    0.0003% |
| 1149 | a53gxx           |                 |                           |                    |              | U      |       12 |    0.0003% |
| 1157 | y560             |                 |                           |                    |              | U      |       11 |    0.0003% |
| 1157 | vegetalte        | BQ              | Aquaris E5 4G, Aquaris E… | Snapdragon 410     | 2014-11-01   | D      |       11 |    0.0003% |
| 1157 | p7_l10           |                 |                           |                    |              | U      |       11 |    0.0003% |
| 1157 | odroidn2l        |                 |                           |                    |              | U      |       11 |    0.0003% |
| 1157 | jflteatt         | Samsung         | Galaxy S4 (SGH-I337)      | Snapdragon 600     | 2013-04-01   | D      |       11 |    0.0003% |
| 1157 | d851             | LG              | G3 (T-Mobile)             | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1157 | d850             | LG              | G3 (AT&T)                 | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1157 | coreprimeve3g    |                 |                           |                    |              | U      |       11 |    0.0003% |
| 1157 | caza             |                 |                           |                    |              | U      |       11 |    0.0003% |
| 1157 | TP1803           | Nubia           | Mini 5G                   | Snapdragon 855     | 2019-04-01   | O      |       11 |    0.0003% |
| 1157 | A5_Pro           |                 |                           |                    |              | U      |       11 |    0.0003% |
| 1168 | m8qlul           |                 |                           |                    |              | U      |       10 |    0.0002% |
| 1168 | ls990            | LG              | G3 (Sprint)               | Snapdragon 801     | 2014-06-01   | D      |       10 |    0.0002% |
| 1168 | i9100g           |                 |                           |                    |              | U      |       10 |    0.0002% |
| 1168 | htc_820g_plus    |                 |                           |                    |              | U      |       10 |    0.0002% |
| 1168 | RMX3242          |                 |                           |                    |              | U      |       10 |    0.0002% |
| 1168 | I01WD            | ASUS            | Zenfone 6 (ZS630KL)       | Snapdragon 855     | 2019-05-16   | D      |       10 |    0.0002% |
| 1174 | urd              |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1174 | h930             |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1174 | frescoltekor     |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1174 | flashlm          |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1174 | f400             | LG              | G3 (Korea)                | Snapdragon 801     | 2014-06-01   | D      |        9 |    0.0002% |
| 1174 | caymanslm        | LG              | Velvet                    | Snapdragon 845     | 2020-07-31   | O      |        9 |    0.0002% |
| 1174 | ahannah          | Motorola        | moto e5 plus (XT1924-3/9) | Snapdragon 430     | 2018-05-01   | D      |        9 |    0.0002% |
| 1174 | a6010            |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1174 | a5ltexx          |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1174 | YUREKA2          |                 |                           |                    |              | U      |        9 |    0.0002% |
| 1184 | x500             |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1184 | wilcoxltexx      |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1184 | vee7             |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1184 | p839v55          |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1184 | onc              |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1184 | Tiare_4_19       |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1184 | GM8_sprout       |                 |                           |                    |              | U      |        8 |    0.0002% |
| 1191 | sltecan          |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | r5xQ             |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | light            |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | kltespr          |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | kinzie           |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | h811             | LG              | G4 (T-Mobile)             | Snapdragon 808     | 2015-06-01   | D      |        7 |    0.0002% |
| 1191 | ef71             |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | ef56             |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | draconis         |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1191 | agate            |                 |                           |                    |              | U      |        7 |    0.0002% |
| 1201 | x1               |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | urushi           |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | trltexx          |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | rs988            | LG              | G5 (US Unlocked)          | Snapdragon 820     | 2016-02-01   | D      |        6 |    0.0001% |
| 1201 | poplar_canada    |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | osaka            |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | maverick         |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | j3xprolte        |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | d838             |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1201 | A7010a48         |                 |                           |                    |              | U      |        6 |    0.0001% |
| 1211 | vidofnir         |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1211 | unified7870      |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1211 | nx589j           |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1211 | j5ltexx          |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1211 | iris             |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1211 | idol4            |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1211 | h96pro           |                 |                           |                    |              | U      |        5 |    0.0001% |
| 1218 | v1               |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1218 | serranolteusc    |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1218 | logan            |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1218 | j7ltechn         |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1218 | j3ltekx          |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1218 | X00QD            |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1218 | NX679J           |                 |                           |                    |              | U      |        4 |   0.00009% |
| 1225 | x1slte           |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | sydney           |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | sf340n           |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | nemo             |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | fortuna3gdtv     |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | cusco            |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | ctwo             |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | Z00RD            |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | X5_Max_Pro       |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1225 | GS290            |                 |                           |                    |              | U      |        3 |   0.00007% |
| 1235 | r5               | OPPO            | R5 (International), R5s … | Snapdragon 615     | 2014-12-01   | D      |        2 |   0.00005% |
| 1235 | h810_usu         |                 |                           |                    |              | U      |        2 |   0.00005% |
| 1235 | e5lte            |                 |                           |                    |              | U      |        2 |   0.00005% |
| 1235 | VFD700           |                 |                           |                    |              | U      |        2 |   0.00005% |
| 1235 | Samsung Galaxy … |                 |                           |                    |              | U      |        2 |   0.00005% |
| 1240 | trltevzw         |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | shamu_t          |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | k11ta_a          |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | j7toplteskt      |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | find7s           |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | d2refreshspr     |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | a71n             |                 |                           |                    |              | U      |        1 |   0.00002% |
| 1240 | RMX3461          |                 |                           |                    |              | U      |        1 |   0.00002% |
|      | Unlisted         |                 |                           |                    |              |        |     5204 |      0.12% |
|      | Total            |                 |                           |                    |              |        |  4299046 |    100.00% |
----------------------------------------------------------------------------------------------------------------------------------------------

Status codes: O=active official build, D=discontinued official build, U=unofficial build

Manufacturers of devices that run LineageOS
----------------------------------------------------------------------
| Rank |      Maker      | Builds | % Builds | Installs | % Installs |
----------------------------------------------------------------------
| 1    | Samsung         |    142 |    11.4% |  1203244 |     27.99% |
| 2    | Motorola        |     69 |     5.5% |  1159431 |     26.97% |
| 3    | Xiaomi          |     91 |     7.3% |   717369 |     16.69% |
| 4    | OPPO            |     12 |     1.0% |   348982 |      8.12% |
| 5    | Huawei          |      9 |     0.7% |   237410 |      5.52% |
| 6    | virtual machine |      7 |     0.6% |   168979 |      3.93% |
| 7    | unknown         |    667 |    53.5% |   108394 |      2.52% |
| 8    | LG              |     39 |     3.1% |    62053 |      1.44% |
| 9    | Realme          |      4 |     0.3% |    57827 |      1.35% |
| 10   | OnePlus         |     30 |     2.4% |    55489 |      1.29% |
| 11   | Google          |     42 |     3.4% |    49592 |      1.15% |
| 12   | Amazon          |      5 |     0.4% |    37221 |      0.87% |
| 13   | Nintendo        |      2 |     0.2% |    23290 |      0.54% |
| 14   | Raspberry Pi    |      3 |     0.2% |    13842 |      0.32% |
| 15   | Sony            |     40 |     3.2% |    12301 |      0.29% |
| 16   | Lenovo          |      9 |     0.7% |     8961 |      0.21% |
| 17   | LeEco           |      3 |     0.2% |     4068 |      0.09% |
| 18   | Nubia           |      7 |     0.6% |     3266 |      0.08% |
| 19   | Fairphone       |      4 |     0.3% |     3149 |      0.07% |
| 20   | ASUS            |     12 |     1.0% |     3068 |      0.07% |
| 21   | C Idea          |      1 |    0.08% |     2749 |      0.06% |
| 22   | ZTE             |      3 |     0.2% |     2349 |      0.05% |
| 23   | Nokia           |      4 |     0.3% |     1545 |      0.04% |
| 24   | HTC             |      7 |     0.6% |     1396 |      0.03% |
| 25   | R36S            |      1 |    0.08% |     1225 |      0.03% |
| 26   | NVIDIA          |      5 |     0.4% |     1159 |      0.03% |
| 27   | Nothing         |      2 |     0.2% |     1029 |      0.02% |
| 28   | Essential       |      1 |    0.08% |     1009 |      0.02% |
| 29   | BQ              |      8 |     0.6% |      723 |      0.02% |
| 30   | Razer           |      2 |     0.2% |      602 |      0.01% |
| 31   | ZUK             |      2 |     0.2% |      486 |      0.01% |
| 32   | Wingtech        |      1 |    0.08% |      355 |     0.008% |
| 33   | F(x)tec         |      2 |     0.2% |      202 |     0.005% |
| 34   | Wileyfox        |      1 |    0.08% |      179 |     0.004% |
| 35   | HardKernel      |      1 |    0.08% |      163 |     0.004% |
| 36   | Walmart         |      1 |    0.08% |      128 |     0.003% |
| 37   | Solana          |      1 |    0.08% |      110 |     0.003% |
| 38   | SHIFT           |      1 |    0.08% |       95 |     0.002% |
| 39   | Banana Pi       |      1 |    0.08% |       89 |     0.002% |
| 40   | Nextbit         |      1 |    0.08% |       84 |     0.002% |
| 41   | Dynalink        |      1 |    0.08% |       74 |     0.002% |
| 42   | Vsmart          |      1 |    0.08% |       72 |     0.002% |
| 43   | Radxa           |      1 |    0.08% |       42 |    0.0010% |
| 44   | Yandex          |      1 |    0.08% |       41 |    0.0010% |
|      | Unlisted        |      ? |        ? |     5204 |      0.12% |
|      | Total           |   1247 |   100.0% |  4299046 |    100.00% |
----------------------------------------------------------------------

Processors of devices that run LineageOS
---------------------------------------------------------------------
| Rank | Processor Type | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Exynos         |     69 |     5.5% |  1021615 |     23.76% |
| 2    | Snapdragon 6   |    119 |     9.5% |  1020127 |     23.73% |
| 3    | Snapdragon 8   |    192 |    15.4% |   596395 |     13.87% |
| 4    | Snapdragon 4   |     62 |     5.0% |   484510 |     11.27% |
| 5    | Snapdragon 7   |     37 |     3.0% |   321367 |      7.48% |
| 6    | Kirin          |      7 |     0.6% |   180412 |      4.20% |
| 7    | X86            |      5 |     0.4% |   152810 |      3.55% |
| 8    | Helio          |     11 |     0.9% |   133369 |      3.10% |
| 9    | unknown        |    668 |    53.6% |   109783 |      2.55% |
| 10   | Omap           |      4 |     0.3% |    68873 |      1.60% |
| 11   | Dimensity      |      1 |    0.08% |    57523 |      1.34% |
| 12   | Mediatek       |      6 |     0.5% |    39041 |      0.91% |
| 13   | Tegra          |     10 |     0.8% |    29185 |      0.68% |
| 14   | Spreadtrum     |      5 |     0.4% |    15413 |      0.36% |
| 15   | Arm            |      1 |    0.08% |    14780 |      0.34% |
| 16   | Broadcom       |      3 |     0.2% |    13842 |      0.32% |
| 17   | Atom           |      3 |     0.2% |    11508 |      0.27% |
| 18   | Tensor         |     15 |     1.2% |     9171 |      0.21% |
| 19   | Snapdragon S   |     18 |     1.4% |     7540 |      0.18% |
| 20   | Snapdragon     |      1 |    0.08% |     2749 |      0.06% |
| 21   | Snapdragon?    |      1 |    0.08% |     1344 |      0.03% |
| 22   | Rockchip       |      1 |    0.08% |     1225 |      0.03% |
| 23   | Qualcomm       |      1 |    0.08% |      683 |      0.02% |
| 24   | Amlogic        |      5 |     0.4% |      496 |      0.01% |
| 25   | Snapdragon 2   |      2 |     0.2% |       81 |     0.002% |
|      | Unlisted       |      ? |        ? |     5204 |      0.12% |
|      | Total          |   1247 |   100.0% |  4299046 |    100.00% |
---------------------------------------------------------------------

Status of LineageOS builds
--------------------------------------------------------
|  Status  | Builds | % Builds | Installs | % Installs |
--------------------------------------------------------
| O        |    239 |    19.2% |  2029546 |     47.21% |
| D        |    243 |    19.5% |   485484 |     11.29% |
| U        |    765 |    61.3% |  1778812 |     41.38% |
| Unlisted |      ? |        ? |     5204 |      0.12% |
| Total    |   1247 |   100.0% |  4299046 |    100.00% |
--------------------------------------------------------

LineageOS versions in active installs
---------------------------------------------------------------
| Rank | Version  | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------
| 1    | 18.1     |    581 |      47% |  1078246 |     25.08% |
| 2    | 21.0     |    528 |      42% |   908219 |     21.13% |
| 3    | 17.1     |    491 |      39% |   852618 |     19.83% |
| 4    | 20.0     |    519 |      42% |   469581 |     10.92% |
| 5    | 19.1     |    407 |      33% |   416110 |      9.68% |
| 6    | 22.2     |    432 |      35% |   162682 |      3.78% |
| 7    | 14.1     |    388 |      31% |   124772 |      2.90% |
| 8    | 15.1     |    287 |      23% |   120543 |      2.80% |
| 9    | 16.0     |    546 |      44% |    71400 |      1.66% |
| 10   | 23.0     |    254 |      20% |    24481 |      0.57% |
| 11   | 17.0     |     89 |       7% |    23916 |      0.56% |
| 12   | 22.1     |    332 |      27% |    14724 |      0.34% |
| 13   | 18.0     |     92 |       7% |    10199 |      0.24% |
| 14   | 13.0     |    139 |      11% |     8570 |      0.20% |
| 15   | 12.1     |      8 |     0.6% |     2020 |      0.05% |
| 16   | 20.3     |      1 |    0.08% |     1829 |      0.04% |
| 17   | 22.0     |    116 |       9% |     1787 |      0.04% |
| 18   | 19.0     |    116 |       9% |     1786 |      0.04% |
| 19   | 10.0     |     26 |       2% |      214 |     0.005% |
| 20   | 16.1     |      2 |     0.2% |       72 |     0.002% |
| 21   | 15.0     |      3 |     0.2% |       20 |    0.0005% |
| 22   | 20.2     |      2 |     0.2% |       19 |    0.0004% |
| 23   | 15.2     |      1 |    0.08% |       10 |    0.0002% |
| 24   | 24.0     |      1 |    0.08% |        8 |    0.0002% |
| 25   | 14.0     |      3 |     0.2% |        4 |   0.00009% |
| 26   | 17.9     |      1 |    0.08% |        2 |   0.00005% |
| 27   | 21.3     |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted |      ? |        ? |     5204 |      0.12% |
|      | Total    |   1247 |     100% |  4299046 |    100.00% |
---------------------------------------------------------------

Years when devices running LineageOS were released
-------------------------------------------------------------------
|   Year   |  Status  | Builds | % Builds | Installs | % Installs |
-------------------------------------------------------------------
| 2011     | O        |      0 |       0% |        0 |         0% |
| 2011     | D        |      2 |     0.2% |      621 |      0.01% |
| 2011     | U        |      0 |       0% |        0 |         0% |
| 2011     | Total    |      2 |     0.2% |      621 |      0.01% |
| 2012     | O        |      0 |       0% |        0 |         0% |
| 2012     | D        |     12 |     1.0% |    15310 |      0.36% |
| 2012     | U        |      6 |     0.5% |    80469 |      1.87% |
| 2012     | Total    |     18 |     1.4% |    95779 |      2.23% |
| 2013     | O        |      0 |       0% |        0 |         0% |
| 2013     | D        |     38 |     3.0% |    34023 |      0.79% |
| 2013     | U        |      3 |     0.2% |    12764 |      0.30% |
| 2013     | Total    |     41 |     3.3% |    46787 |      1.09% |
| 2014     | O        |      0 |       0% |        0 |         0% |
| 2014     | D        |     53 |     4.3% |    28377 |      0.66% |
| 2014     | U        |      8 |     0.6% |    34887 |      0.81% |
| 2014     | Total    |     61 |     4.9% |    63264 |      1.47% |
| 2015     | O        |      2 |     0.2% |      606 |      0.01% |
| 2015     | D        |     45 |     3.6% |    71863 |      1.67% |
| 2015     | U        |      8 |     0.6% |    24336 |      0.57% |
| 2015     | Total    |     55 |     4.4% |    96805 |      2.25% |
| 2016     | O        |      6 |     0.5% |    19334 |      0.45% |
| 2016     | D        |     43 |     3.4% |   243453 |      5.66% |
| 2016     | U        |     14 |     1.1% |   152017 |      3.54% |
| 2016     | Total    |     63 |     5.1% |   414804 |      9.65% |
| 2017     | O        |     17 |     1.4% |   149335 |      3.47% |
| 2017     | D        |     15 |     1.2% |    32857 |      0.76% |
| 2017     | U        |     16 |     1.3% |   343606 |      7.99% |
| 2017     | Total    |     48 |     3.8% |   525798 |     12.23% |
| 2018     | O        |     32 |     2.6% |   354252 |      8.24% |
| 2018     | D        |     24 |     1.9% |    33617 |      0.78% |
| 2018     | U        |     17 |     1.4% |   435894 |     10.14% |
| 2018     | Total    |     73 |     5.9% |   823763 |     19.16% |
| 2019     | O        |     47 |     3.8% |  1272550 |     29.60% |
| 2019     | D        |      5 |     0.4% |    18819 |      0.44% |
| 2019     | U        |     10 |     0.8% |   341694 |      7.95% |
| 2019     | Total    |     62 |     5.0% |  1633063 |     37.99% |
| 2020     | O        |     37 |     3.0% |   163305 |      3.80% |
| 2020     | D        |      5 |     0.4% |     6467 |      0.15% |
| 2020     | U        |      6 |     0.5% |    67106 |      1.56% |
| 2020     | Total    |     48 |     3.8% |   236878 |      5.51% |
| 2021     | O        |     41 |     3.3% |    44563 |      1.04% |
| 2021     | D        |      1 |    0.08% |       77 |     0.002% |
| 2021     | U        |      3 |     0.2% |   162535 |      3.78% |
| 2021     | Total    |     45 |     3.6% |   207175 |      4.82% |
| 2022     | O        |     28 |     2.2% |    11355 |      0.26% |
| 2022     | D        |      0 |       0% |        0 |         0% |
| 2022     | U        |      0 |       0% |        0 |         0% |
| 2022     | Total    |     28 |     2.2% |    11355 |      0.26% |
| 2023     | O        |     22 |     1.8% |    11929 |      0.28% |
| 2023     | D        |      0 |       0% |        0 |         0% |
| 2023     | U        |      1 |    0.08% |     4692 |      0.11% |
| 2023     | Total    |     23 |     1.8% |    16621 |      0.39% |
| 2024     | O        |      6 |     0.5% |     2187 |      0.05% |
| 2024     | D        |      0 |       0% |        0 |         0% |
| 2024     | U        |      0 |       0% |        0 |         0% |
| 2024     | Total    |      6 |     0.5% |     2187 |      0.05% |
| 2025     | O        |      1 |    0.08% |      130 |     0.003% |
| 2025     | D        |      0 |       0% |        0 |         0% |
| 2025     | U        |      2 |     0.2% |     3974 |      0.09% |
| 2025     | Total    |      3 |     0.2% |     4104 |      0.10% |
| unknown  | U        |    671 |    53.8% |   114838 |      2.67% |
| unknown  | Total    |    671 |    53.8% |   114838 |      2.67% |
| Unlisted | Unlisted |      ? |        ? |     5204 |      0.12% |
| Total    | Total    |   1247 |     100% |  4299046 |       100% |
-------------------------------------------------------------------

Reported on Thursday 30 Oct 2025 17:26:30 -04.
Script execution time = 30 minutes 42 seconds
```
