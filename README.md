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
$ php lineageos_stats.php -v

Countries by number of LineageOS installs
---------------------------------------------------------------------------------------------
| Rank |   CC    |        Country         | Installs | % Installs | Installs/M | Pop. (000) |
---------------------------------------------------------------------------------------------
| 1    | BR      | Brazil                 |  1887163 |     43.58% |       8868 |  212812.41 |
| 2    | CN      | China                  |  1304231 |     30.12% |        921 | 1416096.09 |
| 3    | US      | United States          |   307730 |      7.11% |        886 |  347275.81 |
| 4    | Unknown |                        |   259077 |      5.98% |            |            |
| 5    | VN      | Viet Nam               |    92008 |      2.12% |        906 |  101598.53 |
| 6    | DE      | Germany                |    42977 |      0.99% |        511 |   84075.08 |
| 7    | ID      | Indonesia              |    41999 |      0.97% |        147 |  285721.24 |
| 8    | RU      | Russian Federation     |    33199 |      0.77% |        231 |  143997.39 |
| 9    | UA      | Ukraine                |    32033 |      0.74% |        822 |   38980.38 |
| 10   | IN      | India                  |    25963 |      0.60% |         18 | 1463865.53 |
| 11   | KR      | South Korea            |    24550 |      0.57% |        475 |   51667.03 |
| 12   | FR      | France                 |    19511 |      0.45% |        293 |   66650.80 |
| 13   | GB      | United Kingdom         |    14128 |      0.33% |        203 |   69551.33 |
| 14   | ES      | Spain                  |    12828 |      0.30% |        268 |   47889.96 |
| 15   | IT      | Italy                  |    12460 |      0.29% |        211 |   59146.26 |
| 16   | TR      | Turkey                 |    11222 |      0.26% |        128 |   87685.43 |
| 17   | PL      | Poland                 |    10851 |      0.25% |        284 |   38140.91 |
| 18   | TH      | Thailand               |    10718 |      0.25% |        150 |   71619.86 |
| 19   | EG      | Egypt                  |    10622 |      0.25% |         90 |  118366.00 |
| 20   | KG      | Kyrgyzstan             |     8864 |      0.20% |       1215 |    7295.03 |
| 21   | KH      | Cambodia               |     8644 |      0.20% |        484 |   17847.98 |
| 22   | JP      | Japan                  |     8174 |      0.19% |         66 |  123103.48 |
| 23   | MX      | Mexico                 |     7692 |      0.18% |         58 |  131946.90 |
| 24   | NL      | Netherlands            |     6909 |      0.16% |        377 |   18346.82 |
| 25   | CA      | Canada                 |     6765 |      0.16% |        169 |   40126.72 |
| 26   | BD      | Bangladesh             |     4716 |      0.11% |         27 |  175686.90 |
| 27   | IQ      | Iraq                   |     4677 |      0.11% |         99 |   47020.77 |
| 28   | IR      | Iran                   |     4465 |      0.10% |         48 |   92417.68 |
| 29   | AR      | Argentina              |     4310 |      0.10% |         94 |   45851.38 |
| 30   | PK      | Pakistan               |     3914 |      0.09% |         15 |  255219.55 |
| 31   | TW      | Taiwan                 |     3704 |      0.09% |        160 |   23112.79 |
| 32   | PH      | Philippines            |     3625 |      0.08% |         31 |  116786.96 |
| 33   | CO      | Colombia               |     3317 |      0.08% |         62 |   53425.64 |
| 34   | MA      | Morocco                |     3259 |      0.08% |         85 |   38430.77 |
| 35   | AU      | Australia              |     3062 |      0.07% |        114 |   26974.03 |
| 36   | MY      | Malaysia               |     2921 |      0.07% |         81 |   35977.84 |
| 37   | DZ      | Algeria                |     2818 |      0.07% |         59 |   47435.31 |
| 38   | CZ      | Czech Republic         |     2732 |      0.06% |        258 |   10609.24 |
| 38   | AT      | Austria                |     2732 |      0.06% |        300 |    9113.57 |
| 40   | RO      | Romania                |     2725 |      0.06% |        144 |   18908.65 |
| 41   | PT      | Portugal               |     2660 |      0.06% |        255 |   10411.83 |
| 42   | CH      | Switzerland            |     2399 |      0.06% |        268 |    8967.41 |
| 43   | SY      | Syrian Arab Republic   |     2356 |      0.05% |         92 |   25620.43 |
| 44   | SE      | Sweden                 |     2343 |      0.05% |        220 |   10656.63 |
| 45   | LA      | Laos                   |     2332 |      0.05% |        296 |    7873.05 |
| 46   | HU      | Hungary                |     2243 |      0.05% |        233 |    9632.29 |
| 47   | BY      | Belarus                |     2185 |      0.05% |        243 |    8997.60 |
| 48   | NG      | Nigeria                |     2116 |      0.05% |          9 |  237527.78 |
| 49   | PE      | Peru                   |     1958 |      0.05% |         57 |   34576.67 |
| 50   | BE      | Belgium                |     1906 |      0.04% |        162 |   11758.60 |
| 51   | CL      | Chile                  |     1825 |      0.04% |         92 |   19859.92 |
| 52   | GR      | Greece                 |     1797 |      0.04% |        181 |    9938.84 |
| 53   | FI      | Finland                |     1788 |      0.04% |        318 |    5623.33 |
| 54   | AE      | United Arab Emirates   |     1770 |      0.04% |        156 |   11346.00 |
| 55   | HK      | Hong Kong              |     1687 |      0.04% |        228 |    7396.08 |
| 56   | SA      | Saudi Arabia           |     1462 |      0.03% |         42 |   34566.33 |
| 57   | GH      | Ghana                  |     1455 |      0.03% |         41 |   35064.27 |
| 58   | IL      | Israel                 |     1414 |      0.03% |        149 |    9517.18 |
| 59   | VE      | Venezuela              |     1358 |      0.03% |         48 |   28516.90 |
| 60   | MM      | Myanmar                |     1271 |      0.03% |         23 |   54850.65 |
| 61   | SK      | Slovakia               |     1242 |      0.03% |        227 |    5474.88 |
| 62   | KZ      | Kazakhstan             |     1241 |      0.03% |         60 |   20843.75 |
| 63   | OM      | Oman                   |     1216 |      0.03% |        221 |    5494.69 |
| 64   | ZA      | South Africa           |     1208 |      0.03% |         19 |   64747.32 |
| 65   | BG      | Bulgaria               |     1195 |      0.03% |        178 |    6714.56 |
| 66   | RS      | Serbia                 |     1188 |      0.03% |        178 |    6689.04 |
| 67   | EC      | Ecuador                |     1091 |      0.03% |         60 |   18289.90 |
| 68   | MG      | Madagascar             |     1041 |      0.02% |         32 |   32740.68 |
| 69   | BO      | Bolivia                |     1018 |      0.02% |         81 |   12581.84 |
| 70   | LK      | Sri Lanka              |      993 |      0.02% |         43 |   23229.47 |
| 71   | KE      | Kenya                  |      966 |      0.02% |         17 |   57532.49 |
| 72   | NP      | Nepal                  |      962 |      0.02% |         32 |   29618.12 |
| 73   | NZ      | New Zealand            |      942 |      0.02% |        179 |    5251.90 |
| 74   | CM      | Cameroon               |      913 |      0.02% |         31 |   29879.34 |
| 75   | DK      | Denmark                |      895 |      0.02% |        149 |    6002.51 |
| 76   | SV      | El Salvador            |      893 |      0.02% |        140 |    6365.50 |
| 77   | NO      | Norway                 |      892 |      0.02% |        159 |    5623.07 |
| 78   | LT      | Lithuania              |      864 |      0.02% |        305 |    2830.14 |
| 79   | JO      | Jordan                 |      795 |      0.02% |         69 |   11520.68 |
| 80   | UZ      | Uzbekistan             |      766 |      0.02% |         21 |   37053.43 |
| 81   | SG      | Singapore              |      750 |      0.02% |        128 |    5870.75 |
| 82   | AZ      | Azerbaijan             |      715 |      0.02% |         69 |   10397.71 |
| 83   | IE      | Ireland                |      700 |      0.02% |        132 |    5308.04 |
| 84   | HR      | Croatia                |      662 |      0.02% |        172 |    3848.16 |
| 85   | BA      | Bosnia and Herzegovina |      638 |      0.01% |        203 |    3140.10 |
| 86   | MD      | Moldova                |      566 |      0.01% |        189 |    2996.11 |
| 87   | DO      | Dominican Republic     |      534 |      0.01% |         46 |   11520.49 |
| 88   | ET      | Ethiopia               |      526 |      0.01% |          4 |  135472.05 |
| 89   | ZM      | Zambia                 |      503 |      0.01% |         23 |   21913.87 |
| 90   | EE      | Estonia                |      486 |      0.01% |        362 |    1344.23 |
| 91   | SI      | Slovenia               |      472 |      0.01% |        223 |    2117.07 |
| 92   | TN      | Tunisia                |      455 |      0.01% |         37 |   12348.57 |
| 93   | TG      | Togo                   |      433 |     0.010% |         45 |    9721.61 |
| 93   | ML      | Mali                   |      433 |     0.010% |         17 |   25198.82 |
| 95   | GE      | Georgia                |      411 |     0.009% |        108 |    3806.67 |
| 96   | LV      | Latvia                 |      397 |     0.009% |        214 |    1853.56 |
| 97   | UG      | Uganda                 |      382 |     0.009% |          7 |   51384.89 |
| 98   | PY      | Paraguay               |      360 |     0.008% |         51 |    7013.08 |
| 99   | CI      | Côte d'Ivoire          |      355 |     0.008% |         11 |   32711.55 |
| 100  | UY      | Uruguay                |      339 |     0.008% |        100 |    3384.69 |
| 101  | YE      | Yemen                  |      328 |     0.008% |          8 |   41773.88 |
| 102  | CU      | Cuba                   |      325 |     0.008% |         30 |   10937.20 |
| 103  | SN      | Senegal                |      320 |     0.007% |         17 |   18931.97 |
| 104  | CR      | Costa Rica             |      313 |     0.007% |         61 |    5152.95 |
| 105  | AM      | Armenia                |      270 |     0.006% |         91 |    2952.37 |
| 106  | GT      | Guatemala              |      265 |     0.006% |         14 |   18687.88 |
| 107  | AO      | Angola                 |      260 |     0.006% |          7 |   39040.04 |
| 108  | BJ      | Benin                  |      235 |     0.005% |         16 |   14814.46 |
| 109  | CD      | Congo, Democratic Rep… |      228 |     0.005% |          2 |  112832.47 |
| 110  | AL      | Albania                |      212 |     0.005% |         76 |    2771.51 |
| 111  | HN      | Honduras               |      202 |     0.005% |         18 |   11005.85 |
| 112  | TZ      | Tanzania               |      188 |     0.004% |          3 |   70546.00 |
| 113  | LB      | Lebanon                |      182 |     0.004% |         31 |    5849.42 |
| 114  | PA      | Panama                 |      176 |     0.004% |         39 |    4571.19 |
| 115  | AF      | Afghanistan            |      175 |     0.004% |          4 |   43844.11 |
| 116  | MK      | Macedonia              |      173 |     0.004% |         95 |    1813.79 |
| 117  | JM      | Jamaica                |      171 |     0.004% |         60 |    2837.08 |
| 118  | ZW      | Zimbabwe               |      160 |     0.004% |          9 |   16950.80 |
| 119  | QA      | Qatar                  |      159 |     0.004% |         51 |    3115.89 |
| 120  | NI      | Nicaragua              |      158 |     0.004% |         23 |    7007.50 |
| 121  | BH      | Bahrain                |      157 |     0.004% |         96 |    1643.33 |
| 122  | CY      | Cyprus                 |      154 |     0.004% |        112 |    1370.75 |
| 123  | RE      | Réunion                |      146 |     0.003% |        165 |     882.41 |
| 124  | LY      | Libya                  |      143 |     0.003% |         19 |    7458.56 |
| 125  | LU      | Luxembourg             |      140 |     0.003% |        206 |     680.45 |
| 126  | TJ      | Tajikistan             |      135 |     0.003% |         13 |   10786.73 |
| 127  | KW      | Kuwait                 |      133 |     0.003% |         26 |    5026.08 |
| 128  | MZ      | Mozambique             |      126 |     0.003% |          4 |   35631.65 |
| 129  | MW      | Malawi                 |      120 |     0.003% |          5 |   22216.12 |
| 129  | GM      | Gambia                 |      120 |     0.003% |         43 |    2822.09 |
| 131  | SL      | Sierra Leone           |       88 |     0.002% |         10 |    8819.79 |
| 132  | TT      | Trinidad and Tobago    |       87 |     0.002% |         58 |    1511.16 |
| 133  | IS      | Iceland                |       85 |     0.002% |        213 |     398.27 |
| 134  | BF      | Burkina Faso           |       83 |     0.002% |          3 |   24074.58 |
| 135  | MT      | Malta                  |       81 |     0.002% |        149 |     545.41 |
| 136  | ME      | Montenegro             |       79 |     0.002% |        125 |     632.73 |
| 137  | MN      | Mongolia               |       75 |     0.002% |         21 |    3517.10 |
| 138  | MV      | Maldives               |       69 |     0.002% |        130 |     529.68 |
| 139  | CG      | Congo                  |       67 |     0.002% |         10 |    6484.44 |
| 140  | SD      | Sudan                  |       65 |     0.002% |          1 |   51662.15 |
| 140  | MU      | Mauritius              |       65 |     0.002% |         51 |    1268.28 |
| 142  | RW      | Rwanda                 |       60 |     0.001% |          4 |   14569.34 |
| 142  | PG      | Papua New Guinea       |       60 |     0.001% |          6 |   10762.82 |
| 142  | GN      | Guinea                 |       60 |     0.001% |          4 |   15099.73 |
| 145  | SB      | Solomon Islands        |       57 |     0.001% |         68 |     838.65 |
| 146  | TM      | Turkmenistan           |       56 |     0.001% |          7 |    7618.85 |
| 147  | MC      | Monaco                 |       52 |     0.001% |       1356 |      38.34 |
| 148  | BN      | Brunei Darussalam      |       48 |     0.001% |        103 |     466.33 |
| 149  | HT      | Haiti                  |       46 |     0.001% |          4 |   11906.10 |
| 150  | MO      | Macao                  |       44 |     0.001% |         61 |     722.00 |
| 150  | GP      | Guadeloupe             |       44 |     0.001% |        118 |     373.79 |
| 152  | NA      | Namibia                |       40 |    0.0009% |         13 |    3092.82 |
| 153  | ER      | Eritrea                |       38 |    0.0009% |         11 |    3607.00 |
| 154  | PR      | Puerto Rico            |       33 |    0.0008% |         10 |    3235.29 |
| 155  | NE      | Niger                  |       32 |    0.0007% |          1 |   27917.83 |
| 156  | BZ      | Belize                 |       31 |    0.0007% |         73 |     422.92 |
| 157  | AD      | Andorra                |       28 |    0.0006% |        338 |      82.90 |
| 158  | LR      | Liberia                |       26 |    0.0006% |          5 |    5731.21 |
| 159  | MR      | Mauritania             |       25 |    0.0006% |          5 |    5315.07 |
| 159  | GA      | Gabon                  |       25 |    0.0006% |         10 |    2593.13 |
| 159  | BW      | Botswana               |       25 |    0.0006% |         10 |    2562.12 |
| 162  | SR      | Suriname               |       24 |    0.0006% |         38 |     639.85 |
| 162  | SO      | Somalia                |       24 |    0.0006% |          1 |   19654.74 |
| 164  | KP      | North Korea            |       22 |    0.0005% |        0.8 |   26571.00 |
| 165  | BI      | Burundi                |       21 |    0.0005% |          1 |   14390.00 |
| 166  | CV      | Cape Verde             |       19 |    0.0004% |         36 |     527.33 |
| 167  | XK      | Kosovo                 |       18 |    0.0004% |         11 |    1674.13 |
| 168  | KM      | Comoros                |       17 |    0.0004% |         19 |     882.85 |
| 168  | GY      | Guyana                 |       17 |    0.0004% |         20 |     835.99 |
| 170  | FJ      | Fiji                   |       16 |    0.0004% |         17 |     933.15 |
| 171  | TD      | Chad                   |       15 |    0.0003% |        0.7 |   21003.71 |
| 172  | LI      | Liechtenstein          |       14 |    0.0003% |        349 |      40.13 |
| 173  | CW      | Curaçao                |       13 |    0.0003% |         70 |     185.49 |
| 174  | PF      | French Polynesia       |       11 |    0.0003% |         39 |     282.47 |
| 174  | NC      | New Caledonia          |       11 |    0.0003% |         37 |     295.33 |
| 174  | GW      | Guinea-Bissau          |       11 |    0.0003% |          5 |    2249.52 |
| 177  | VA      | Vatican City           |       10 |    0.0002% |      20000 |       0.50 |
| 178  | DJ      | Djibouti               |        8 |    0.0002% |          7 |    1184.08 |
| 178  | BT      | Bhutan                 |        8 |    0.0002% |         10 |     796.68 |
| 178  | BB      | Barbados               |        8 |    0.0002% |         28 |     282.62 |
| 181  | FO      | Faroe Islands          |        7 |    0.0002% |        125 |      56.00 |
| 182  | GL      | Greenland              |        6 |    0.0001% |        108 |      55.75 |
| 182  | CF      | Central African Repub… |        6 |    0.0001% |          1 |    5513.28 |
| 182  | BS      | Bahamas                |        6 |    0.0001% |         15 |     403.03 |
| 185  | VC      | Saint Vincent and the… |        5 |    0.0001% |         50 |      99.92 |
| 185  | SZ      | Eswatini               |        5 |    0.0001% |          4 |    1256.17 |
| 185  | ST      | Sao Tome and Principe  |        5 |    0.0001% |         21 |     240.25 |
| 185  | SS      | South Sudan            |        5 |    0.0001% |        0.4 |   12188.79 |
| 185  | SC      | Seychelles             |        5 |    0.0001% |         38 |     132.78 |
| 190  | TL      | Timor-Leste            |        4 |   0.00009% |          3 |    1418.52 |
| 190  | PS      | Palestine, State of    |        4 |   0.00009% |        0.7 |    5589.62 |
| 190  | GQ      | Equatorial Guinea      |        4 |   0.00009% |          2 |    1938.43 |
| 190  | AW      | Aruba                  |        4 |   0.00009% |         37 |     108.15 |
| 194  | SM      | San Marino             |        3 |   0.00007% |         89 |      33.57 |
| 194  | NN      | Sint Maarten (Dutch p… |        3 |   0.00007% |         68 |      43.92 |
| 194  | LC      | Saint Lucia            |        3 |   0.00007% |         17 |     180.15 |
| 194  | KY      | Cayman Islands         |        3 |   0.00007% |         40 |      75.84 |
| 194  | GU      | Guam                   |        3 |   0.00007% |         18 |     169.00 |
| 194  | GI      | Gibraltar              |        3 |   0.00007% |         75 |      40.13 |
| 194  | GD      | Grenada                |        3 |   0.00007% |         26 |     117.30 |
| 194  | EH      | Western Sahara         |        3 |   0.00007% |          5 |     600.90 |
| 194  | DM      | Dominica               |        3 |   0.00007% |         46 |      65.87 |
| 194  | AS      | American Samoa         |        3 |   0.00007% |         65 |      46.03 |
| 194  | AI      | Anguilla               |        3 |   0.00007% |        204 |      14.73 |
| 205  | LS      | Lesotho                |        2 |   0.00005% |        0.8 |    2363.33 |
| 205  | EA      |                        |        2 |   0.00005% |            |            |
| 207  | WS      | Samoa                  |        1 |   0.00002% |          5 |     219.31 |
| 207  | TO      | Tonga                  |        1 |   0.00002% |         10 |     103.74 |
| 207  | PW      | Palau                  |        1 |   0.00002% |         57 |      17.66 |
| 207  | NF      | Norfolk Island         |        1 |   0.00002% |            |            |
| 207  | KI      | Kiribati               |        1 |   0.00002% |          7 |     136.49 |
| 207  | IO      | British Indian Ocean … |        1 |   0.00002% |         25 |      39.73 |
| 207  | FK      | Falkland Islands (Mal… |        1 |   0.00002% |        288 |       3.47 |
| 207  | AG      | Antigua and Barbuda    |        1 |   0.00002% |         11 |      94.21 |
|      | World   | World                  |  4330004 |       100% |        526 | 8231613.07 |
---------------------------------------------------------------------------------------------

Downloading builds from http://stats.lineageos.org. Press 'b' to break downloads.

LineageOS builds by number of installs
-------------------------------------------------------------------------------------------------------------------------------------------
| Rank |      Build       |    Maker     |           Model           |     Processor      | Mod.Released | Status | Installs | % Installs |
-------------------------------------------------------------------------------------------------------------------------------------------
| 1    | channel          | Motorola     | moto g7 play              | Snapdragon 632     | 2019-03-01   | O      |   356992 |      8.24% |
| 2    | dipper           | Xiaomi       | Mi 8                      | Snapdragon 845     | 2018-07-01   | O      |   326237 |      7.53% |
| 3    | lake             | Motorola     | moto g7 plus              | Snapdragon 636     | 2019-02-01   | O      |   183962 |      4.25% |
| 4    | jeter            | Motorola     | moto g6 play              | Snapdragon 430     | 2018-05-01   | U      |   177173 |      4.09% |
| 5    | ocean            | Motorola     | moto g7 power             | Snapdragon 632     | 2019-02-01   | O      |   163493 |      3.78% |
| 6    | beyond0lte       | Samsung      | Galaxy S10e               | Exynos 9820        | 2019-03-08   | O      |   153821 |      3.55% |
| 7    | waydroid_x86_64  | virtual      | Waydroid on x86_64        | x86                | 2021-07-01   | U      |   148090 |      3.42% |
| 8    | beyond1lte       | Samsung      | Galaxy S10                | Exynos 9820        | 2019-03-08   | O      |   146662 |      3.39% |
| 9    | OP4AA7           | OPPO         | K5                        | Snapdragon 730G    | 2019-10-01   | U      |   126763 |      2.93% |
| 10   | sanders          | Motorola     | Moto G5S Plus             | Snapdragon 625     | 2017-08-01   | U      |   124619 |      2.88% |
| 11   | beyond2lte       | Samsung      | Galaxy S10+               | Exynos 9825        | 2019-08-23   | O      |   115404 |      2.67% |
| 12   | hero2lte         | Samsung      | Galaxy S7 Edge            | Exynos 8890        | 2016-03-18   | D      |   108363 |      2.50% |
| 13   | greatlte         | Samsung      | Galaxy Note 8             | Exynos 8895        | 2017-09-01   | U      |   101365 |      2.34% |
| 14   | herolte          | Samsung      | Galaxy S7                 | Exynos 8890        | 2016-03-18   | D      |   100152 |      2.31% |
| 15   | sagit            | Xiaomi       | Mi 6                      | Snapdragon 835     | 2017-04-01   | O      |    92838 |      2.14% |
| 16   | a71              | Samsung      | Galaxy A71                | Snapdragon 730     | 2020-01-17   | O      |    78983 |      1.82% |
| 17   | ugg              | Xiaomi       | Redmi Note 5A Prime, Red… | Snapdragon 435     | 2017-11-01   | U      |    64723 |      1.49% |
| 18   | A57              | OPPO         | A57 (2016)                | Snapdragon 435     | 2016-12-01   | U      |    64484 |      1.49% |
| 19   | HWPAR            | Huawei       | Nova 3                    | Kirin 970          | 2018-08-01   | U      |    63682 |      1.47% |
| 20   | RMX2201CN        | Realme       | V3 5G                     | Dimensity 720      | 2020-09-10   | U      |    63454 |      1.47% |
| 21   | R9               | OPPO         | R9                        | Helio P10          | 2016-03-01   | U      |    63432 |      1.46% |
| 22   | PACM00           | OPPO         | R15 10                    | Helio P60          | 2018-04-01   | U      |    63301 |      1.46% |
| 23   | HWSEA-A          | Huawei       | Nova 5 Pro                | Kirin 980          | 2019-06-01   | U      |    63257 |      1.46% |
| 24   | HWMAR            | Huawei       | P30 Lite                  | Kirin 710          | 2019-04-25   | U      |    63240 |      1.46% |
| 25   | prada            | LG           | Prada 3.0                 | OMAP 4430          | 2012-01-01   | U      |    63219 |      1.46% |
| 26   | HWDUB-Q          | Huawei       | Y7 Prime 2019             | Snapdragon 450     | 2019-01-01   | U      |    62704 |      1.45% |
| 27   | PBDM00           | OPPO         | R17 Pro / RX17 Pro        | Snapdragon 710     | 2018-11-01   | U      |    62554 |      1.44% |
| 28   | troika           | Motorola     | one action                | Exynos 9609        | 2019-10-31   | O      |    47911 |      1.11% |
| 29   | miatoll          | Xiaomi       | POCO M2 Pro, Redmi Note … | Snapdragon 720G    | 2020-07-14   | O      |    34450 |      0.80% |
| 30   | zerofltexx       | Samsung      | Galaxy S6                 | Exynos 7420        | 2015-04-01   | D      |    31507 |      0.73% |
| 31   | j8y18lte         | Samsung      | J8 (2018)                 | Snapdragon 450     | 2018-07-01   | U      |    27951 |      0.65% |
| 32   | kane             | Motorola     | one vision, p50           | Exynos 9609        | 2019-05-15   | O      |    27875 |      0.64% |
| 33   | river            | Motorola     | moto g7                   | Snapdragon 632     | 2019-02-01   | O      |    25333 |      0.59% |
| 34   | a20              | Samsung      | Galaxy A20                | Exynos 7884        | 2019-04-05   | U      |    24247 |      0.56% |
| 35   | nx_tab           | Nintendo     | Switch v1 [Tablet], Swit… | Tegra X1 (T210)    | 2017-03-03   | O      |    22098 |      0.51% |
| 36   | tiffany          | Xiaomi       | Mi 5X                     | Snapdragon 625     | 2017-09-01   | U      |    17710 |      0.41% |
| 37   | waydroid_arm64   | virtual      | Waydroid on ARM64         | ARM                | 2021-07-01   | U      |    16895 |      0.39% |
| 38   | karnak           | Amazon       | Fire HD 8                 | MediaTek MT8163    | 2018-10-04   | U      |    16689 |      0.39% |
| 39   | matissewifi      | Samsung      | Galaxy Tab 4 10.1 Wi-Fi   | Snapdragon 400     | 2014-06-01   | U      |    14201 |      0.33% |
| 40   | apollon          | Xiaomi       | Mi 10T, Mi 10T Pro, Redm… | Snapdragon 865     | 2020-10-01   | O      |    13765 |      0.32% |
| 41   | lavender         | Xiaomi       | Redmi Note 7              | Snapdragon 660     | 2019-01-01   | D      |    13124 |      0.30% |
| 42   | a70q             | Samsung      | Galaxy A70 (SM-A705)      | Snapdragon 675     | 2019-05-01   | U      |    12706 |      0.29% |
| 43   | tissot           | Xiaomi       | Mi A1                     | Snapdragon 625     | 2017-10-01   | D      |    12046 |      0.28% |
| 44   | n8000            | Samsung      | Galaxy Note 10.1          | Exynos 4 Quad 4412 | 2012-08-01   | U      |    10597 |      0.24% |
| 45   | j6primelte       | Samsung      | Galaxy J6+                | Snapdragon 425     | 2018-09-25   | U      |    10590 |      0.24% |
| 46   | dumpling         | OnePlus      | OnePlus 5T                | Snapdragon 835     | 2017-11-01   | O      |     9863 |      0.23% |
| 47   | gtel3g           | Samsung      | Galaxy Tab E              | Spreadtrum SC7730S | 2015-07-01   | U      |     8877 |      0.21% |
| 48   | p10              | Huawei       | P10                       | Kirin 960          | 2017-03-01   | U      |     8814 |      0.20% |
| 49   | on7xelte         | Samsung      | Galaxy J7 Prime           | Exynos 7870        | 2016-09-01   | U      |     8756 |      0.20% |
| 50   | gemini           | Xiaomi       | Mi 5                      | Snapdragon 820     | 2016-04-01   | O      |     8702 |      0.20% |
| 51   | n8010            | Samsung      | Galaxy Note 10.1 (N8010)  | Exynos 4 Quad 4412 | 2012-08-01   | U      |     8174 |      0.19% |
| 52   | rpi4             | Raspberry Pi | Raspberry Pi 4            | Broadcom BCM2711   | 2019-06-24   | U      |     8048 |      0.19% |
| 53   | Mi439            | Xiaomi       | Redmi 7A, Redmi 8, Redmi… | Snapdragon 439     | 2019-05-28   | O      |     7920 |      0.18% |
| 54   | a30              | Samsung      | Galaxy A30                | Exynos 7904        | 2019-03-01   | U      |     7537 |      0.17% |
| 55   | mustang          | Amazon       | Fire 7 (2019)             | Mediatek MT8163    | 2019-06-06   | U      |     7356 |      0.17% |
| 56   | whyred           | Xiaomi       | Redmi Note 5 Pro          | Snapdragon 636     | 2018-02-01   | D      |     6951 |      0.16% |
| 57   | espresso3g       | Samsung      | Galaxy Tab 2 7.0 (GSM), … | OMAP 4430          | 2012-04-01   | D      |     6921 |      0.16% |
| 58   | j4primelte       | Samsung      | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |     6850 |      0.16% |
| 59   | ford             | Amazon       | Fire 7" (ford)            | MediaTek MT8127    | 2015-11-01   | U      |     6705 |      0.15% |
| 60   | santos10wifi     | Samsung      | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     6676 |      0.15% |
| 61   | douglas          | Amazon       | Fire HD 8 (2017)          | MediaTek MT8163    | 2017-06-01   | U      |     6673 |      0.15% |
| 62   | crownlte         | Samsung      | Galaxy Note 9             | Exynos 9810        | 2018-08-09   | D      |     6530 |      0.15% |
| 63   | gtaxlwifi        | Samsung      | Galaxy Tab A 10.1" (2016) | Exynos 7870 Octa   | 2016-05-01   | U      |     6395 |      0.15% |
| 64   | sweet            | Xiaomi       | Redmi Note 10 Pro, Redmi… | Snapdragon 732G    | 2021-03-01   | O      |     6361 |      0.15% |
| 65   | Mi8937           | Xiaomi       | Redmi 3S, Redmi 3X, Redm… | Snapdragon 430     | 2016-06-14   | O      |     6116 |      0.14% |
| 66   | core33g          | Samsung      | Galaxy Core Prime (SM-G3… | Snapdragon 410     | 2014-11-01   | U      |     5808 |      0.13% |
| 67   | TB8703           | Lenovo       | TAB 3 8 Plus              | Snapdragon 625     | 2017-03-01   | U      |     5687 |      0.13% |
| 68   | ginkgo           | Xiaomi       | Redmi Note 8, Redmi Note… | Snapdragon 665     | 2019-08-01   | O      |     5636 |      0.13% |
| 69   | starlte          | Samsung      | Galaxy S9                 | Exynos 9810        | 2018-03-11   | D      |     5587 |      0.13% |
| 70   | star2lte         | Samsung      | Galaxy S9+                | Exynos 9810        | 2018-03-11   | D      |     5286 |      0.12% |
| 71   | beryllium        | Xiaomi       | POCO F1                   | Snapdragon 845     | 2018-08-01   | O      |     5227 |      0.12% |
| 72   | a5y17lte         | Samsung      | Galaxy A5 (2017)          | Exynos 7880        | 2017-01-02   | D      |     5098 |      0.12% |
| 73   | alioth           | Xiaomi       | POCO F3, Redmi K40, Mi 1… | Snapdragon 870     | 2021-03-01   | O      |     5052 |      0.12% |
| 74   | enchilada        | OnePlus      | OnePlus 6                 | Snapdragon 845     | 2018-04-01   | O      |     4993 |      0.12% |
| 75   | fajita           | OnePlus      | OnePlus 6T, OnePlus 6T (… | Snapdragon 845     | 2018-11-01   | O      |     4908 |      0.11% |
| 76   | m20lte           | Samsung      | Galaxy M20                | Exynos 7904        | 2019-01-28   | D      |     4871 |      0.11% |
| 77   | klte             | Samsung      | Galaxy S5 LTE (G900F/M/R… | Snapdragon 801     | 2014-04-11   | D      |     4738 |      0.11% |
| 78   | rpi5             | Raspberry Pi | Raspberry Pi 5            | Broadcom BCM2712   | 2023-10-23   | U      |     4709 |      0.11% |
| 79   | n1awifi          | Samsung      | Galaxy Note 10.1 Wi-Fi (… | Exynos 5420        | 2013-10-10   | D      |     4630 |      0.11% |
| 80   | j7elte           | Samsung      | Galaxy J7 (2015)          | Exynos 7580        | 2015-06-01   | D      |     4418 |      0.10% |
| 80   | clover           | Xiaomi       | Xiaomi Mi Pad 4           | Snapdragon 660     | 2018-06-25   | U      |     4418 |      0.10% |
| 82   | cheeseburger     | OnePlus      | OnePlus 5                 | Snapdragon 835     | 2017-06-01   | O      |     4411 |      0.10% |
| 83   | montana          | Motorola     | moto g5s                  | Snapdragon 430     | 2017-08-01   | D      |     4405 |      0.10% |
| 84   | harpia           | Motorola     | moto g4 play              | Snapdragon 410     | 2016-05-01   | D      |     4352 |      0.10% |
| 85   | mido             | Xiaomi       | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | D      |     4269 |      0.10% |
| 86   | r8q              | Samsung      | Galaxy S20 FE, Galaxy S2… | Snapdragon 865     | 2021-04-23   | O      |     4227 |      0.10% |
| 87   | coral            | Google       | Pixel 4 XL                | Snapdragon 855     | 2019-09-01   | O      |     4183 |      0.10% |
| 88   | gtexslte         | Samsung      | Galaxy Tab A 7.0 LTE (20… | Snapdragon 410     | 2016-03-01   | U      |     4071 |      0.09% |
| 89   | sunfish          | Google       | Pixel 4a                  | Snapdragon 730G    | 2020-08-01   | O      |     3997 |      0.09% |
| 90   | mocha            | Xiaomi       | Mi Pad 1                  | Tegra K1 (T124)    | 2014-06-01   | U      |     3907 |      0.09% |
| 91   | blueline         | Google       | Pixel 3                   | Snapdragon 845     | 2018-10-01   | O      |     3887 |      0.09% |
| 92   | hlte             | Samsung      | Galaxy Note 3 LTE (N9005… | Snapdragon 800     | 2013-09-01   | D      |     3819 |      0.09% |
| 93   | blossom          | Xiaomi       | Redmi 9A, Redmi 9C, Redm… | Helio G25 / G35    | 2020-07-07   | U      |     3739 |      0.09% |
| 94   | evert            | Motorola     | moto g6 plus              | Snapdragon 630     | 2018-05-01   | O      |     3650 |      0.08% |
| 95   | austin           | Amazon       | Fire 7" (Austin)          | MediaTek MT8127    | 2017-06-01   | U      |     3641 |      0.08% |
| 96   | santos103g       | Samsung      | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     3629 |      0.08% |
| 97   | espressowifi     | Samsung      | Galaxy Tab 2 7.0 (Wi-Fi … | OMAP 4430          | 2012-05-01   | D      |     3547 |      0.08% |
| 98   | rosemary         | Xiaomi       | Redmi Note 10S, Redmi No… | Helio G95          | 2021-04-01   | O      |     3502 |      0.08% |
| 99   | flo              | Google       | Nexus 7 (Wi-Fi, 2013 ver… | Snapdragon S4 Pro  | 2013-07-26   | D      |     3468 |      0.08% |
| 100  | wayne            | Xiaomi       | Mi 6X                     | Snapdragon 660     | 2018-04-01   | D      |     3411 |      0.08% |
| 101  | instantnoodlep   | OnePlus      | OnePlus 8 Pro             | Snapdragon 865     | 2020-04-01   | O      |     3390 |      0.08% |
| 102  | chiron           | Xiaomi       | Mi MIX 2                  | Snapdragon 835     | 2017-09-01   | O      |     3383 |      0.08% |
| 103  | laurel_sprout    | Xiaomi       | Mi A3                     | Snapdragon 665     | 2019-07-01   | O      |     3369 |      0.08% |
| 104  | sargo            | Google       | Pixel 3a                  | Snapdragon 670     | 2019-04-01   | O      |     3338 |      0.08% |
| 105  | potter           | Motorola     | Moto G5 Plus              | Snapdragon 625     | 2017-04-01   | U      |     3283 |      0.08% |
| 106  | vayu             | Xiaomi       | POCO X3 Pro               | Snapdragon 860     | 2021-03-01   | O      |     3159 |      0.07% |
| 107  | guacamole        | OnePlus      | OnePlus 7 Pro, OnePlus 7… | Snapdragon 855     | 2019-05-01   | O      |     3035 |      0.07% |
| 108  | redfin           | Google       | Pixel 5                   | Snapdragon 765G 5G | 2020-10-01   | O      |     2984 |      0.07% |
| 109  | n5100            | Samsung      | Galaxy Note 8.0 (GSM)     | Exynos 4412        | 2013-04-01   | D      |     2886 |      0.07% |
| 110  | surya            | Xiaomi       | POCO X3 NFC               | Snapdragon 732G    | 2020-09-08   | O      |     2861 |      0.07% |
| 111  | kebab            | OnePlus      | OnePlus 8T, OnePlus 8T (… | Snapdragon 865     | 2020-10-01   | O      |     2843 |      0.07% |
| 112  | lmi              | Xiaomi       | POCO F2 Pro, Redmi K30 P… | Snapdragon 865     | 2020-05-01   | O      |     2826 |      0.07% |
| 113  | gta4xlwifi       | Samsung      | Galaxy Tab S6 Lite (Wi-F… | Exynos 9611        | 2020-04-02   | O      |     2820 |      0.07% |
| 114  | nx563j           | Nubia        | Z17                       | Snapdragon 835     | 2017-06-01   | O      |     2813 |      0.06% |
| 115  | gtaxllte         | Samsung      | Galaxy Tab A (SM-T580)    | Exynos 7870 Octa   | 2016-05-01   | U      |     2811 |      0.06% |
| 116  | x2               | LeEco        | Le Max2                   | Snapdragon 820     | 2016-04-01   | D      |     2752 |      0.06% |
| 117  | chagallwifi      | Samsung      | Galaxy Tab S 10.5 Wi-Fi … | Exynos 5420        | 2014-07-01   | D      |     2746 |      0.06% |
| 118  | onclite          | Xiaomi       | Redmi 7, Redmi Y3         | Snapdragon 632     | 2019-03-01   | O      |     2734 |      0.06% |
| 119  | merlinx          | Xiaomi       | Redmi Note 9              | Helio G85          | 2020-05-01   | D      |     2718 |      0.06% |
| 120  | viennalte        | Samsung      | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-13   | U      |     2715 |      0.06% |
| 121  | chagalllte       | Samsung      | Galaxy Tab S 10.5 LTE     | Exynos 5420        | 2014-07-01   | D      |     2697 |      0.06% |
| 122  | gtexswifi        | Samsung      | Galaxy Tab A 7.0          | Spreadtrum SC8830  | 2016-03-01   | U      |     2663 |      0.06% |
| 123  | A37              | OPPO         | A37, A37f, A37fw          | Snapdragon 410     | 2016-06-01   | U      |     2562 |      0.06% |
| 124  | a10              | Samsung      | Galaxy A10                | Exynos 7884        | 2019-03-01   | U      |     2505 |      0.06% |
| 125  | gts4lvwifi       | Samsung      | Galaxy Tab S5e (Wi-Fi)    | Snapdragon 670     | 2019-04-01   | O      |     2456 |      0.06% |
| 126  | matisse3g        | Samsung      | Galaxy Tab 4 10.1 3G      | Snapdragon 400     | 2014-06-01   | U      |     2430 |      0.06% |
| 127  | lemonade         | OnePlus      | OnePlus 9, OnePlus 9 (T-… | Snapdragon 888     | 2021-03-01   | O      |     2409 |      0.06% |
| 128  | davinci          | Xiaomi       | Mi 9T, Redmi K20 (China)… | Snapdragon 730     | 2019-06-01   | O      |     2371 |      0.05% |
| 129  | R11              | OPPO         | R11                       | Snapdragon 660     | 2017-06-01   | U      |     2354 |      0.05% |
| 130  | bacon            | OnePlus      | OnePlus One               | Snapdragon 801     | 2014-06-06   | D      |     2320 |      0.05% |
| 131  | oneplus3         | OnePlus      | OnePlus 3, OnePlus 3T     | Snapdragon 820     | 2016-06-01   | D      |     2267 |      0.05% |
| 132  | i9300            | Samsung      | Galaxy S III (Internatio… | Exynos 4412        | 2012-05-29   | D      |     2266 |      0.05% |
| 133  | x86_64_tv        | virtual      | Android TV on x86_64      | x86                |              | U      |     2245 |      0.05% |
| 134  | lemonadep        | OnePlus      | OnePlus 9 Pro, OnePlus 9… | Snapdragon 888     | 2021-03-01   | O      |     2236 |      0.05% |
| 135  | mondrianwifi     | Samsung      | Galaxy Tab Pro 8.4        | Snapdragon 800     | 2014-01-01   | D      |     2171 |      0.05% |
| 136  | garden           | Xiaomi       | Redmi 9A, Redmi 9C        | Helio G25          | 2020-07-07   | U      |     2116 |      0.05% |
| 137  | star2qltechn     | Samsung      | Galaxy S9+                | Snapdragon 845     | 2018-03-16   | U      |     2114 |      0.05% |
| 138  | gts210vewifi     | Samsung      | Galaxy Tab S2 9.7 Wi-Fi … | Snapdragon 652     | 2016-08-01   | D      |     2065 |      0.05% |
| 139  | vince            | Xiaomi       | Redmi 5 Plus              | Snapdragon 625     | 2017-12-07   | U      |     2046 |      0.05% |
| 140  | serranoltexx     | Samsung      | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |     2012 |      0.05% |
| 141  | cactus           | Xiaomi       | Redmi 6A                  | Helio A22          | 2018-06-15   | U      |     2011 |      0.05% |
| 142  | j5xnlte          | Samsung      | Galaxy J5 (J510MN/GN/FN)  | Snapdragon 410     | 2016-04-01   | U      |     2004 |      0.05% |
| 143  | matisselte       | Samsung      | Galaxy Tab 4 10.1 LTE     | Snapdragon 400     | 2014-05-01   | U      |     1972 |      0.05% |
| 144  | taimen           | Google       | Pixel 2 XL                | Snapdragon 835     | 2017-10-01   | O      |     1951 |      0.05% |
| 145  | gta4lwifi        | Samsung      | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1930 |      0.04% |
| 146  | noblelte         | Samsung      | Galaxy Note 5             | Exynos 7420 Octa   | 2015-08-21   | U      |     1915 |      0.04% |
| 147  | android_x86_64   | virtual      | Android on x86_64         | x86                |              | U      |     1873 |      0.04% |
| 148  | n2awifi          | Samsung      | Galaxy Tab PRO 10.1       | Exynos 5420        | 2014-02-01   | D      |     1865 |      0.04% |
| 149  | umi              | Xiaomi       | Mi 10                     | Snapdragon 865     | 2020-02-01   | O      |     1804 |      0.04% |
| 150  | walleye          | Google       | Pixel 2                   | Snapdragon 835     | 2017-10-01   | O      |     1786 |      0.04% |
| 151  | polaris          | Xiaomi       | Mi MIX 2S                 | Snapdragon 845     | 2018-04-01   | O      |     1779 |      0.04% |
| 152  | lisa             | Xiaomi       | Xiaomi 11 Lite 5G NE, Xi… | Snapdragon 778G 5G | 2021-09-01   | O      |     1776 |      0.04% |
| 153  | treltexx         | Samsung      | Galaxy Note 4             | Exynos 5433 Octa   | 2014-10-01   | U      |     1775 |      0.04% |
| 154  | a7y17lte         | Samsung      | Galaxy A7 (2017)          | Exynos 7880        | 2017-01-02   | D      |     1749 |      0.04% |
| 155  | instantnoodle    | OnePlus      | OnePlus 8, OnePlus 8 (T-… | Snapdragon 865     | 2020-04-01   | O      |     1745 |      0.04% |
| 156  | hotdogb          | OnePlus      | OnePlus 7T, OnePlus 7T (… | Snapdragon 855+    | 2019-09-01   | O      |     1739 |      0.04% |
| 157  | lancelot         | Xiaomi       | Redmi 9                   | Helio G85          | 2020-06-01   | D      |     1735 |      0.04% |
| 158  | crosshatch       | Google       | Pixel 3 XL                | Snapdragon 845     | 2018-10-01   | O      |     1726 |      0.04% |
| 159  | hammerhead       | Google       | Nexus 5                   | Snapdragon 800     | 2013-10-31   | D      |     1722 |      0.04% |
| 160  | y2s              | Samsung      | Galaxy S20+, Galaxy S20+… | Exynos 990         | 2020-03-06   | U      |     1688 |      0.04% |
| 161  | a52sxq           | Samsung      | Galaxy A52s 5G            | Snapdragon 778G 5G | 2021-09-01   | O      |     1687 |      0.04% |
| 162  | X00TD            | ASUS         | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | D      |     1686 |      0.04% |
| 163  | tulip            | ZTE          | Axon 7 Mini               | Snapdragon 617     | 2016-09-01   | D      |     1662 |      0.04% |
| 164  | avicii           | OnePlus      | OnePlus Nord              | Snapdragon 765G    | 2020-07-21   | D      |     1659 |      0.04% |
| 165  | renoir           | Xiaomi       | Mi 11 Lite 5G             | Snapdragon 780G 5G | 2021-03-01   | O      |     1655 |      0.04% |
| 166  | a5xelte          | Samsung      | Galaxy A5 (2016)          | Exynos 7580        | 2015-12-01   | D      |     1605 |      0.04% |
| 167  | cedric           | Motorola     | moto g5                   | Snapdragon 430     | 2017-03-01   | D      |     1596 |      0.04% |
| 168  | beyondx          | Samsung      | Galaxy S10 5G             | Exynos 9820        | 2019-03-08   | O      |     1592 |      0.04% |
| 169  | grandppltedx     | Samsung      | Galaxy J2 Prime / Grand … | MediaTek MT6737T   | 2016-11-01   | U      |     1581 |      0.04% |
| 170  | suez             | Amazon       | Fire HD 10                | MediaTek MT8173    | 2017-06-01   | U      |     1556 |      0.04% |
| 170  | libra            | Xiaomi       | Mi 4c                     | Snapdragon 808     | 2015-09-01   | D      |     1556 |      0.04% |
| 172  | a6lte            | Samsung      | Galaxy A6 (Exynos7870)    | Exynos 7870        | 2018-05-01   | U      |     1553 |      0.04% |
| 173  | starqltechn      | Samsung      | Galaxy S9                 | Snapdragon 845     | 2018-03-16   | U      |     1543 |      0.04% |
| 174  | flox             | Google       | Nexus 7 2013 (Wi-Fi, Rep… | Snapdragon S4 Pro  | 2013-07-26   | D      |     1540 |      0.04% |
| 175  | gta4l            | Samsung      | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1537 |      0.04% |
| 176  | kenzo            | Xiaomi       | Redmi Note 3              | Snapdragon 650     | 2016-02-01   | D      |     1529 |      0.04% |
| 176  | a21s             | Samsung      | Galaxy A21s               | Exynos 850         | 2020-06-02   | O      |     1529 |      0.04% |
| 178  | helium           | Xiaomi       | Mi Max                    | Snapdragon 652     | 2016-05-01   | U      |     1494 |      0.03% |
| 179  | bonito           | Google       | Pixel 3a XL               | Snapdragon 670     | 2019-04-01   | O      |     1491 |      0.03% |
| 180  | jfltexx          | Samsung      | Galaxy S4 (GT-I9505, SGH… | Snapdragon 600     | 2013-04-01   | D      |     1455 |      0.03% |
| 181  | marble           | Xiaomi       | POCO F5 (Global), POCO F… | Snapdragon 7+ Gen… | 2023-05-09   | O      |     1424 |      0.03% |
| 182  | a3xelte          | Samsung      | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | D      |     1416 |      0.03% |
| 183  | ms013g           | Samsung      | Galaxy Grand 2 Duos       | Snapdragon 400     | 2013-11-25   | D      |     1412 |      0.03% |
| 184  | n7100            | Samsung      | Galaxy Note II            | Exynos 4412 Quad   | 2012-10-01   | U      |     1365 |      0.03% |
| 185  | bluejay          | Google       | Pixel 6a                  | Tensor GS101       | 2022-07-01   | O      |     1357 |      0.03% |
| 186  | TBX704           | Lenovo       | Tab 4 10 Plus             | Snapdragon? 625    | 2017-07-01   | U      |     1335 |      0.03% |
| 187  | gts4lv           | Samsung      | Galaxy Tab S5e (LTE)      | Snapdragon 670     | 2019-04-01   | O      |     1330 |      0.03% |
| 188  | deen             | Motorola     | One                       | Snapdragon 625     | 2020-07-02   | U      |     1319 |      0.03% |
| 189  | certus           | Xiaomi       | Redmi 6 / 6A              | Helio A22          | 2018-06-01   | U      |     1313 |      0.03% |
| 190  | D22AP            | virtual      | Android 12 (API 22)       |                    |              | U      |     1311 |      0.03% |
| 191  | gt58wifi         | Samsung      | Tab A 2015 8.0 (SM-T350)  | Snapdragon 410     | 2015-05-01   | U      |     1293 |      0.03% |
| 192  | grus             | Xiaomi       | Mi 9 SE                   | Snapdragon 712     | 2019-02-01   | O      |     1271 |      0.03% |
| 193  | gauguin          | Xiaomi       | Mi 10T Lite 5G, Mi 10i 5… | Snapdragon 750G 5G | 2020-10-01   | O      |     1259 |      0.03% |
| 194  | a7y18lte         | Samsung      | Galaxy A7 (2018)          | Exynos 7 Octa 7885 | 2018-10-01   | U      |     1256 |      0.03% |
| 195  | v1awifi          | Samsung      | Galaxy Note Pro 12.2 Wi-… | Exynos 5420        | 2014-02-01   | D      |     1237 |      0.03% |
| 196  | tokay            | Google       | Pixel 9                   | Tensor G4          | 2024-08-22   | O      |     1230 |      0.03% |
| 197  | waydroid_x86     | virtual      | Waydroid on i386          | x86                | 2021-07-01   | U      |     1218 |      0.03% |
| 198  | FP3              | Fairphone    | Fairphone 3, Fairphone 3+ | Snapdragon 632     | 2019-09-01   | O      |     1195 |      0.03% |
| 199  | r36s             | R36S         | R36S with Panel 4         | Rockchip RK3326    | 2025-05-31   | U      |     1194 |      0.03% |
| 199  | fogos            | Motorola     | moto g34 5G, moto g45 5G  | Snapdragon 695     | 2023-12-29   | O      |     1194 |      0.03% |
| 201  | flame            | Google       | Pixel 4                   | Snapdragon 855     | 2019-09-01   | O      |     1180 |      0.03% |
| 202  | klimtwifi        | Samsung      | Galaxy Tab S 8.4 Wi-Fi    | Exynos 5420        | 2014-07-01   | D      |     1179 |      0.03% |
| 203  | oneplus2         | OnePlus      | OnePlus 2                 | Snapdragon 810     | 2015-08-28   | D      |     1177 |      0.03% |
| 204  | a52q             | Samsung      | Galaxy A52 4G             | Snapdragon 720G    | 2021-03-26   | O      |     1173 |      0.03% |
| 205  | pioneer          | Sony         | Xperia XA2                | Snapdragon 630     | 2018-02-01   | O      |     1149 |      0.03% |
| 206  | rpi3             | Raspberry Pi | Raspberry Pi 3            | Broadcom BCM2837   | 2016-02-29   | U      |     1145 |      0.03% |
| 206  | lt01wifi         | Samsung      | Galaxy Tab 3 8.0 (SM-T31… | Exynos 4 Dual 4212 | 2013-07-01   | U      |     1145 |      0.03% |
| 206  | j5lte            | Samsung      | Galaxy J5 (2015)          | Snapdragon 410     | 2015-06-26   | U      |     1145 |      0.03% |
| 209  | xmsirius         | Xiaomi       | Mi 8 SE                   | Snapdragon 710     | 2018-06-01   | D      |     1134 |      0.03% |
| 210  | n8013            | Samsung      | Galaxy Note 10.1 WiFi     | Exynos 4412        | 2012-08-01   | U      |     1131 |      0.03% |
| 211  | merlin           | Motorola     | moto g3 turbo             | Snapdragon 615     | 2015-11-01   | D      |     1120 |      0.03% |
| 212  | violet           | Xiaomi       | Redmi Note 7 Pro          | Snapdragon 675     | 2019-03-13   | O      |     1118 |      0.03% |
| 213  | n5110            | Samsung      | Galaxy Note 8.0 (Wi-Fi)   | Exynos 4412        | 2013-04-01   | D      |     1102 |      0.03% |
| 214  | waydroid_tv_x86… | virtual      |                           | X86_64             |              | U      |     1095 |      0.03% |
| 215  | lilac            | Sony         | Xperia XZ1 Compact        | Snapdragon 835     | 2017-10-01   | U      |     1093 |      0.03% |
| 216  | hydrogen         | Xiaomi       | Mi Max                    | Snapdragon 650     | 2016-05-01   | D      |     1077 |      0.02% |
| 217  | nx               | Nintendo     | Switch v1 [Android TV], … | Tegra X1 (T210)    | 2017-03-03   | O      |     1075 |      0.02% |
| 218  | devon            | Motorola     | moto g32                  | Snapdragon 680 4G  | 2022-08-01   | O      |     1056 |      0.02% |
| 219  | FP4              | Fairphone    | Fairphone 4               | Snapdragon 750G    | 2021-10-01   | O      |     1048 |      0.02% |
| 220  | hltekor          | Samsung      | Galaxy Note 3 LTE (N900K… | Snapdragon 800     | 2013-09-01   | D      |     1028 |      0.02% |
| 221  | mata             | Essential    | PH-1                      | Snapdragon 835     | 2017-08-01   | O      |     1025 |      0.02% |
| 222  | daisy            | Xiaomi       | Mi A2 Lite                | Snapdragon 625     | 2018-07-01   | U      |     1016 |      0.02% |
| 223  | guacamoleb       | OnePlus      | OnePlus 7                 | Snapdragon 855     | 2019-05-01   | O      |     1012 |      0.02% |
| 224  | ysl              | Xiaomi       | Redmi S2, Redmi Y2        | Snapdragon 625     | 2018-05-01   | U      |     1000 |      0.02% |
| 224  | armani           | Xiaomi       | Redmi 1S                  | Snapdragon 400     | 2014-05-01   | D      |     1000 |      0.02% |
| 226  | bangkk           | Motorola     | moto g84 5G               | Snapdragon 695     | 2023-09-08   | O      |      996 |      0.02% |
| 227  | gts3lwifi        | Samsung      | Galaxy Tab S3 WiFi        | Snapdragon 820     | 2017-03-24   | U      |      992 |      0.02% |
| 228  | gt510wifi        | Samsung      | Tab A 2015 9.7 SM-T550    | Snapdragon 410     | 2015-05-01   | U      |      985 |      0.02% |
| 229  | d2s              | Samsung      | Galaxy Note10+            | Exynos 9825        | 2019-08-23   | O      |      976 |      0.02% |
| 230  | android_x86      | virtual      | Android on x86            | x86                |              | U      |      970 |      0.02% |
| 231  | ha3g             | Samsung      | Galaxy Note 3 (Internati… | Exynos 5420        | 2013-09-01   | D      |      956 |      0.02% |
| 232  | panther          | Google       | Pixel 7                   | Tensor GS201       | 2022-10-13   | O      |      955 |      0.02% |
| 233  | Mi8937_4_19      | Xiaomi       | Redmi 4X                  | Snapdragon 435     | 2017-02-28   | U      |      953 |      0.02% |
| 234  | lynx             | Google       | Pixel 7a                  | Tensor GS201       | 2023-05-10   | O      |      952 |      0.02% |
| 234  | klimtlte         | Samsung      | Galaxy Tab S 10.5 LTE (S… | Exynos 5 Octa 5420 | 2014-07-01   | U      |      952 |      0.02% |
| 236  | bramble          | Google       | Pixel 4a 5G               | Snapdragon 765G    | 2020-10-01   | O      |      950 |      0.02% |
| 237  | Mi8917           | Xiaomi       | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-04   | O      |      942 |      0.02% |
| 238  | payton           | Motorola     | moto x4                   | Snapdragon 630     | 2017-10-01   | O      |      937 |      0.02% |
| 239  | xz2c             | Sony         | Xperia XZ2 Compact        | Snapdragon 845     | 2018-04-01   | O      |      936 |      0.02% |
| 240  | joan             | LG           | V30 (Unlocked), V30 (T-M… | Snapdragon 835     | 2017-08-01   | O      |      929 |      0.02% |
| 241  | n8020            | Samsung      | Galaxy Note 10.1 (N8020)  | Exynos 4 Quad 4412 | 2012-12-01   | U      |      919 |      0.02% |
| 241  | fog              | Xiaomi       | Redmi 10C                 | Snapdragon 680 4G  | 2022-03-23   | U      |      919 |      0.02% |
| 243  | gta4xlveu        | Samsung      | Galaxy Tab S6 Lite        | Snapdragon 732G o… | 2022-05-23   | U      |      917 |      0.02% |
| 244  | rhode            | Motorola     | moto g52                  | Snapdragon 680 4G  | 2022-04-01   | O      |      907 |      0.02% |
| 245  | peridot          | Xiaomi       | Poco F6, Redmi Turbo 3    | Snapdragon 8s Gen… | 2024-05-23   | U      |      888 |      0.02% |
| 246  | gts28vewifi      | Samsung      | Galaxy Tab S2 8.0 Wi-Fi … | Snapdragon 652     | 2015-09-01   | D      |      886 |      0.02% |
| 247  | gts210wifi       | Samsung      | Galaxy Tab S2 9.7 (Wi-Fi) | Exynos 5433        | 2015-09-01   | D      |      874 |      0.02% |
| 248  | grandneove3g     | Samsung      | Galaxy Grand Neo Plus     | Spreadtrum SC8830  | 2015-01-01   | U      |      872 |      0.02% |
| 249  | s2               | LeEco        | Le 2                      | Snapdragon 652     | 2016-04-01   | D      |      870 |      0.02% |
| 250  | gts210ltexx      | Samsung      | Galaxy Tab S2 9.7 (LTE)   | Exynos 5433        | 2015-09-01   | D      |      869 |      0.02% |
| 251  | pyxis            | Xiaomi       | Mi CC 9, Mi 9 Lite        | Snapdragon 665     | 2019-07-01   | O      |      865 |      0.02% |
| 251  | oriole           | Google       | Pixel 6                   | Tensor GS101       | 2021-10-19   | O      |      865 |      0.02% |
| 253  | PL2              | Nokia        | Nokia 6.1 (2018)          | Snapdragon 630     | 2018-05-06   | O      |      859 |      0.02% |
| 254  | rosy             | Xiaomi       | Redmi 5                   | Snapdragon 450     | 2017-12-01   | U      |      857 |      0.02% |
| 255  | larry            | OnePlus      | OnePlus Nord CE 3 Lite 5… | Snapdragon 695     | 2023-04-11   | O      |      850 |      0.02% |
| 256  | gtanotexlwifi    | Samsung      | Galaxy Tab A 10.1 S Pen … | Exynos 7870 Octa   | 2016-10-01   | U      |      846 |      0.02% |
| 257  | bullhead         | Google       | Nexus 5X                  | Snapdragon 808     | 2015-09-29   | D      |      845 |      0.02% |
| 258  | guamp            | Motorola     | moto g9 play, moto g9, K… | Snapdragon 662     | 2020-08-01   | O      |      843 |      0.02% |
| 259  | a51              | Samsung      | Galaxy A51 (SM-A515F)     | Exynos 9611        | 2019-12-16   | U      |      840 |      0.02% |
| 260  | gtowifi          | Samsung      | Galaxy Tab A 8.0 (2019)   | Snapdragon 429     | 2019-07-01   | O      |      831 |      0.02% |
| 261  | s5neolte         | Samsung      | Galaxy S5 Neo             | Exynos 7580        | 2015-08-01   | D      |      827 |      0.02% |
| 262  | lt03lte          | Samsung      | Galaxy Note 10.1 2014 (L… | Snapdragon 800     | 2013-10-01   | D      |      826 |      0.02% |
| 262  | ali              | Motorola     | Moto G6, Moto 1S          | Snapdragon 450     | 2018-04-01   | U      |      826 |      0.02% |
| 264  | spes             | Xiaomi       | Redmi Note 11             | Snapdragon 680     | 2022-02-09   | U      |      823 |      0.02% |
| 265  | osprey           | Motorola     | moto g (2015)             | Snapdragon 410     | 2015-07-01   | D      |      821 |      0.02% |
| 266  | shamu            | Google       | Nexus 6                   | Snapdragon 805     | 2014-10-29   | D      |      814 |      0.02% |
| 267  | trlte            | Samsung      | Galaxy Note 4 (SM-N910F/… | Snapdragon 805     | 2014-10-01   | U      |      805 |      0.02% |
| 268  | YTX703F          | Lenovo       | Yoga Tab 3 Plus Wi-Fi     | Snapdragon 652     | 2016-12-01   | D      |      801 |      0.02% |
| 269  | jasmine_sprout   | Xiaomi       | Mi A2                     | Snapdragon 660     | 2018-07-01   | D      |      800 |      0.02% |
| 270  | ginna            | Motorola     | Moto E (2020)             | Snapdragon 632     | 2020-06-10   | U      |      792 |      0.02% |
| 271  | sofiar           | Motorola     | G8 Power                  | Snapdragon 665     | 2020-04-16   | U      |      791 |      0.02% |
| 272  | gtelwifiue       | Samsung      | Galaxy Tab E 9.6 (WiFi)   | Snapdragon 410     | 2015-07-01   | D      |      790 |      0.02% |
| 273  | kiev             | Motorola     | moto g 5G, moto one 5G a… | Snapdragon 750G    | 2020-05-01   | O      |      788 |      0.02% |
| 274  | j2y18lte         | Samsung      | Galaxy J2 2018            | Snapdragon 425     | 2018-01-01   | U      |      787 |      0.02% |
| 275  | cepheus          | Xiaomi       | Mi 9                      | Snapdragon 855     | 2019-03-25   | U      |      782 |      0.02% |
| 276  | thor             | Xiaomi       | Xiaomi 12S Ultra          | Snapdragon 8+ Gen1 | 2022-07-09   | O      |      764 |      0.02% |
| 277  | gts3llte         | Samsung      | Galaxy Tab S3 9.7 LTE (S… | Snapdragon 820     | 2017-04-01   | U      |      763 |      0.02% |
| 278  | fortuna3g        | Samsung      | Galaxy Grand Prime (SM-S… | Snapdragon 410     | 2014-10-01   | U      |      759 |      0.02% |
| 279  | jason            | Xiaomi       | Mi Note 3                 | Snapdragon 660     | 2017-09-01   | D      |      752 |      0.02% |
| 280  | nash             | Motorola     | moto z2 force, moto z (2… | Snapdragon 835     | 2017-07-01   | O      |      751 |      0.02% |
| 281  | earth            | Xiaomi       | Redmi 12C, Redmi 12C NFC… | Helio G85          | 2023-01-01   | O      |      745 |      0.02% |
| 282  | marlin           | Google       | Pixel XL                  | Snapdragon 821     | 2016-10-01   | O      |      742 |      0.02% |
| 283  | chime            | Xiaomi       | Redmi 9T, Redmi 9 Power,… | Snapdragon 662     | 2021-01-18   | U      |      740 |      0.02% |
| 284  | natrium          | Xiaomi       | Mi 5s Plus                | Snapdragon 821     | 2016-10-01   | O      |      738 |      0.02% |
| 285  | x86_64           |              | x86 64bits                | x86_64             |              | U      |      736 |      0.02% |
| 286  | hotdog           | OnePlus      | OnePlus 7T Pro            | Snapdragon 855+    | 2019-10-01   | O      |      731 |      0.02% |
| 287  | athene           | Motorola     | moto g4                   | Snapdragon 617     | 2016-05-01   | D      |      729 |      0.02% |
| 288  | milletwifi       | Samsung      | Galaxy Tab 4 8.0 Wi-Fi    | Snapdragon 400     | 2014-06-01   | U      |      728 |      0.02% |
| 289  | begonia          | Xiaomi       | Redmi Note 8 Pro          | Helio G90T         | 2019-09-01   | U      |      724 |      0.02% |
| 290  | platina          | Xiaomi       | Mi 8 Lite                 | Snapdragon 660     | 2018-09-01   | D      |      719 |      0.02% |
| 291  | x1s              | Samsung      | Galaxy S20, Galaxy S20 5G | Exynos 990         | 2020-03-06   | U      |      716 |      0.02% |
| 292  | hermes           | Xiaomi       | Redmi Note 2              | Helio X10          | 2015-08-14   | U      |      705 |      0.02% |
| 293  | sailfish         | Google       | Pixel                     | Snapdragon 821     | 2016-10-01   | O      |      702 |      0.02% |
| 294  | m1721            | Meizu        | M6 Note (m1721)           | Snapdragon 625     | 2017-09-01   | U      |      698 |      0.02% |
| 295  | santoni          | Xiaomi       | Redmi 4(X)                | Snapdragon 435     | 2017-05-01   | D      |      696 |      0.02% |
| 296  | falcon           | Motorola     | moto g                    | Snapdragon 400     | 2013-11-01   | D      |      691 |      0.02% |
| 297  | j7xelte          | Samsung      | J7 (2016) (J710F)         | Exynos 7870        | 2016-04-01   | U      |      682 |      0.02% |
| 298  | gta4xl           | Samsung      | Galaxy Tab S6 Lite (LTE)  | Exynos 9611        | 2020-04-02   | O      |      681 |      0.02% |
| 299  | FP5              | Fairphone    | Fairphone 5               | Qualcomm QCM6490   | 2023-08-01   | O      |      677 |      0.02% |
| 300  | m8               | HTC          | One (M8)                  | Snapdragon 801     | 2014-03-01   | D      |      675 |      0.02% |
| 300  | fogo             | Motorola     | moto g 5G - 2024          | Snapdragon 765G    | 2020-05-01   | O      |      675 |      0.02% |
| 302  | aries            | Xiaomi       | Mi 2                      | Snapdragon S4 Pro  | 2012-11-01   | U      |      671 |      0.02% |
| 303  | j3xlte           | Samsung      | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830A | 2016-05-06   | U      |      668 |      0.02% |
| 304  | federer          | Huawei       | MediaPad T2 10.0 Pro      | Snapdragon 615     | 2016-09-01   | U      |      662 |      0.02% |
| 305  | rova             | Xiaomi       | Redmi 4A, Redmi 5A        | Snapdragon 425     | 2016-11-01   | U      |      660 |      0.02% |
| 305  | caprip           | Motorola     | moto g30, K13 Pro         | Snapdragon 662     | 2021-03-01   | O      |      660 |      0.02% |
| 307  | zeroflte         | Samsung      | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa … | 2015-04-01   | U      |      659 |      0.02% |
| 308  | j3xnlte          | Samsung      | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830I | 2016-05-06   | U      |      657 |      0.02% |
| 309  | dubai            | Motorola     | edge 30                   | Snapdragon 778G+ … | 2022-05-01   | O      |      650 |      0.02% |
| 310  | zeroltexx        | Samsung      | Galaxy S6 Edge            | Exynos 7420        | 2015-04-01   | D      |      649 |      0.01% |
| 311  | Spacewar         | Nothing      | Phone (1)                 | Snapdragon 778G+ … | 2022-07-12   | O      |      646 |      0.01% |
| 312  | gracerlte        | Samsung      | Galaxy Note FE, Galaxy N… | Exynos 8890 (14nm) | 2016-08-19   | U      |      644 |      0.01% |
| 313  | munch            | Xiaomi       | POCO F4, Redmi K40S       | Snapdragon 870     | 2022-06-01   | O      |      643 |      0.01% |
| 313  | a7xelte          | Samsung      | Galaxy A7 (2016)          | Exynos 7580        | 2015-12-01   | D      |      643 |      0.01% |
| 315  | n1a3g            | Samsung      | Galaxy Note 10.1 (2014) … | Exynos 5420        | 2013-10-01   | U      |      642 |      0.01% |
| 315  | deb              | Google       | Nexus 7 2013 (LTE)        | Snapdragon S4 Pro  | 2013-07-26   | D      |      642 |      0.01% |
| 317  | osborn           |              |                           |                    |              | U      |      641 |      0.01% |
| 318  | golden           | Samsung      | Galaxy S3 Mini, Galaxy S… | NovaThor U8420     | 2012-11-01   | U      |      634 |      0.01% |
| 319  | i9082            | Samsung      | Galaxy Grand Duos i9082,… | Broadcom BCM28155  | 2013-01-01   | U      |      632 |      0.01% |
| 320  | g0215d           | GREE         | G0215D                    | Snapdragon 820     | 2018-08-01   | U      |      621 |      0.01% |
| 321  | rolex            | Xiaomi       | Redmi 4A                  | Snapdragon 425     | 2016-11-01   | U      |      620 |      0.01% |
| 322  | starfire         | Lenovo       | ThinkSmart View (CD-1878… | Qualcomm APQ8053   | 2020-08-01   | U      |      612 |      0.01% |
| 322  | gts28wifi        | Samsung      | Galaxy Tab S2 (8.0”, Wi-… | Exynos 5 Octa 5433 | 2015-09-01   | U      |      612 |      0.01% |
| 324  | lt013g           | Samsung      | Galaxy Tab III 8.0 3G, G… | Exynos 4212 Dual   | 2013-07-01   | U      |      604 |      0.01% |
| 325  | cancro           | Xiaomi       | Mi 3, Mi 4                | Snapdragon 800     | 2013-10-01   | D      |      603 |      0.01% |
| 326  | cupid            | Xiaomi       | Xiaomi 12                 | Snapdragon 8 Gen1  | 2021-12-31   | O      |      589 |      0.01% |
| 326  | akita            | Google       | Pixel 8a                  | Tensor G3          | 2023-10-04   | O      |      589 |      0.01% |
| 328  | x103f            | Lenovo       | Tab 10, Tab3 10 (TB-X103… | Snapdragon 210 or… | 2016-06-01   | U      |      588 |      0.01% |
| 328  | onyx             | OnePlus      | OnePlus X                 | Snapdragon 801     | 2015-11-01   | D      |      588 |      0.01% |
| 328  | odroidn2         | HardKernel   | ODROID-N2                 | Amlogic S922X      | 2019-02-01   | U      |      588 |      0.01% |
| 331  | cheetah          | Google       | Pixel 7 Pro               | Tensor GS201       | 2022-10-13   | O      |      586 |      0.01% |
| 332  | akari            | Sony         | Xperia XZ2                | Snapdragon 845     | 2018-04-01   | O      |      582 |      0.01% |
| 333  | dre              | OnePlus      | OnePlus Nord N200         | Snapdragon 480     | 2021-06-21   | O      |      581 |      0.01% |
| 334  | billie           | OnePlus      | OnePlus Nord N10          | Snapdragon 690 5G  | 2020-10-26   | O      |      579 |      0.01% |
| 335  | d2x              | Samsung      | Galaxy Note10+ 5G         | Exynos 9825        | 2019-08-23   | O      |      575 |      0.01% |
| 336  | j2lte            | Samsung      | Galaxy J2 (J200M/F/G/GU/… | Exynos 3475 Quad   | 2015-09-01   | U      |      573 |      0.01% |
| 337  | latte            | Xiaomi       | Mi Pad 2                  | Atom X5-Z8500      | 2015-11-01   | U      |      567 |      0.01% |
| 338  | jasmine          | ZTE          | AT&T Trek 2 HD            | Snapdragon 617     | 2016-08-01   | D      |      565 |      0.01% |
| 339  | raven            | Google       | Pixel 6 Pro               | Tensor GS101       | 2021-10-19   | O      |      562 |      0.01% |
| 340  | ugglite          | Xiaomi       | Redmi Y1, Redmi Note 5A,… | Snapdragon 435     | 2017-08-21   | U      |      560 |      0.01% |
| 341  | i9100            | Samsung      | Galaxy S II               | Exynos 4210        | 2011-02-11   | D      |      548 |      0.01% |
| 342  | salami           | OnePlus      | OnePlus 11 5G             | Snapdragon 8 Gen2  | 2023-01-01   | O      |      547 |      0.01% |
| 343  | angler           | Google       | Nexus 6P                  | Snapdragon 810     | 2015-09-29   | D      |      546 |      0.01% |
| 344  | x86_64_tv_go     |              |                           | x86_64             |              | U      |      545 |      0.01% |
| 345  | angelica         | Xiaomi       | Redmi 9C                  | Helio G35 (12 nm)  | 2020-08-12   | U      |      538 |      0.01% |
| 346  | shiba            | Google       | Pixel 8                   | Tensor G3          | 2023-10-04   | O      |      537 |      0.01% |
| 347  | perseus          | Xiaomi       | Mi MIX 3                  | Snapdragon 845     | 2018-11-01   | O      |      531 |      0.01% |
| 348  | j7velte          | Samsung      | Galaxy J7 NXT (J701F)     | Exynos 7870 Octa   | 2017-07-01   | U      |      530 |      0.01% |
| 349  | bach             | Huawei       | MediaPad M3 Lite 8, Medi… | Snapdragon 435     | 2017-06-01   | U      |      529 |      0.01% |
| 350  | maple_dsds       | Sony         | Xperia XZ Premium Dual S… | Snapdragon 835     | 2017-06-18   | U      |      527 |      0.01% |
| 351  | twolip           | Xiaomi       | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | D      |      525 |      0.01% |
| 352  | a3y17lte         | Samsung      | Galaxy A3 (2017) (SM-A32… | Exynos 7870 Octa   | 2017-01-01   | U      |      518 |      0.01% |
| 353  | hulkbuster       |              |                           |                    |              | U      |      517 |      0.01% |
| 354  | haydn            | Xiaomi       | Mi 11i, Redmi K40 Pro, R… | Snapdragon 888     | 2021-01-01   | O      |      512 |      0.01% |
| 355  | s3ve3gjv         | Samsung      | Galaxy S III Neo (Samsun… | Snapdragon 400     | 2014-04-11   | D      |      508 |      0.01% |
| 356  | millet3g         | Samsung      | Galaxy Tab 4 8.0 3G       | Snapdragon 400     | 2014-06-01   | U      |      505 |      0.01% |
| 357  | a3lte            | Samsung      | Galaxy A3 (2015)          | Snapdragon 410     | 2014-12-01   | U      |      496 |      0.01% |
| 358  | gts28ltexx       | Samsung      | Galaxy Tab S2 9.7 G3/LTE… | Exynos 5433        | 2015-09-01   | U      |      493 |      0.01% |
| 359  | barbet           | Google       | Pixel 5a                  | Snapdragon 765G    | 2021-08-01   | O      |      491 |      0.01% |
| 360  | gts210velte      | Samsung      | Galaxy Tab S2 9.7 LTE (S… | Snapdragon 652     | 2015-09-01   | U      |      488 |      0.01% |
| 360  | grouper          | ASUS         | Nexus 7 2012              | Tegra 3            | 2012-07-01   | U      |      488 |      0.01% |
| 362  | t0lte            | Samsung      | Galaxy Note 2 (LTE)       | Exynos 4412        | 2012-09-01   | D      |      487 |      0.01% |
| 363  | jfvelte          | Samsung      | Galaxy S4 Value Edition … | Snapdragon 600     | 2014-04-01   | D      |      485 |      0.01% |
| 364  | cereus           | Xiaomi       | Redmi 6                   | Helio P22 (12 nm)  | 2018-06-01   | U      |      482 |      0.01% |
| 365  | serrano3gxx      | Samsung      | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      481 |      0.01% |
| 365  | kuntao           | Lenovo       | P2                        | Snapdragon 625     | 2016-11-01   | D      |      481 |      0.01% |
| 365  | berlin           | Motorola     | edge 20                   | Snapdragon 778G 5G | 2021-07-29   | O      |      481 |      0.01% |
| 368  | kyleproxx        | Samsung      | Galaxy S Duos 2           | Broadcom BCM 2814… | 2013-12-01   | U      |      480 |      0.01% |
| 369  | ido              | Xiaomi       | Redmi 3, Redmi 3 Prime    | Snapdragon 616     | 2016-01-01   | D      |      479 |      0.01% |
| 370  | lt033g           | Samsung      | Galaxy Note 10.1 2014 Ed… | Exynos 5420        | 2013-10-10   | U      |      478 |      0.01% |
| 371  | cmi              | Xiaomi       | Mi 10 Pro                 | Snapdragon 865     | 2020-02-01   | O      |      475 |      0.01% |
| 372  | fleur            | Xiaomi       | Redmi Note 11S, POCO M4 … | Helio G96 (12 nm)  | 2022-02-09   | U      |      474 |      0.01% |
| 373  | ks01ltexx        | Samsung      | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | U      |      473 |      0.01% |
| 374  | pdx206           | Sony         | Xperia 5 II               | Snapdragon 865     | 2020-09-01   | O      |      472 |      0.01% |
| 375  | serranodsdd      | Samsung      | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      468 |      0.01% |
| 376  | wseries          |              |                           |                    |              | U      |      467 |      0.01% |
| 377  | pdx215           | Sony         | Xperia 1 III              | Snapdragon 888     | 2021-04-01   | O      |      463 |      0.01% |
| 378  | flashlmdd        | LG           | V50 ThinQ                 | Snapdragon 855     | 2019-02-01   | O      |      458 |      0.01% |
| 379  | j7y17lte         | Samsung      | Galaxy J7 Pro             | Exynos 7870 Octa   | 2017-07-01   | U      |      457 |      0.01% |
| 380  | topaz            | Xiaomi       | Redmi Note 12 4G, Redmi … | Snapdragon 685     | 2023-03-01   | U      |      451 |      0.01% |
| 380  | s3ve3gds         | Samsung      | Galaxy S III Neo (Dual S… | Snapdragon 400     | 2014-04-11   | D      |      451 |      0.01% |
| 380  | garnet           | Xiaomi       | Redmi Note13 Pro 5G, Poc… | Snapdragon 7s Gen… | 2023-09-26   | U      |      451 |      0.01% |
| 383  | zerolte          | Samsung      | Galaxy S6 Edge (SM-G925F) | Exynos 7420 Octa   | 2015-04-10   | U      |      449 |      0.01% |
| 384  | gts7lwifi        | Samsung      | Galaxy Tab S7 (Wi-Fi)     | Snapdragon 865+    | 2020-08-21   | O      |      445 |      0.01% |
| 384  | foster           | NVIDIA       | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      445 |      0.01% |
| 384  | equuleus         | Xiaomi       | Mi 8 Pro                  | Snapdragon 845     | 2018-09-01   | O      |      445 |      0.01% |
| 387  | nio              | Motorola     | edge s, moto g100         | Snapdragon 870     | 2021-02-01   | O      |      437 |      0.01% |
| 388  | akatsuki         | Sony         | Xperia XZ3                | Snapdragon 845     | 2018-10-01   | O      |      436 |      0.01% |
| 389  | mondrian         | Xiaomi       | POCO F5 Pro, Redmi K60    | Snapdragon 8+ Gen1 | 2023-05-09   | O      |      435 |      0.01% |
| 389  | mh2lm            | LG           | G8X ThinQ (G850EM/EMW), … | Snapdragon 855     | 2019-06-01   | O      |      435 |      0.01% |
| 389  | a505f            | Samsung      | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |      435 |      0.01% |
| 392  | waffle           | OnePlus      | OnePlus 12                | Snapdragon 8 Gen3  | 2023-12-01   | O      |      434 |      0.01% |
| 393  | husky            | Google       | Pixel 8 Pro               | Tensor G3          | 2023-10-04   | O      |      433 |     0.010% |
| 394  | d1x              | Samsung      | Galaxy Note10 5G          | Exynos 9825        | 2019-08-23   | O      |      432 |     0.010% |
| 395  | kugo             | Sony         | Xperia X Compact          | Snapdragon 650     | 2016-09-08   | D      |      431 |     0.010% |
| 396  | ingres           | Xiaomi       | Poco F4 GT, Redmi K50 Ga… | Snapdragon 8 Gen 1 | 2022-04-28   | U      |      430 |     0.010% |
| 396  | aura             | Razer        | Phone 2                   | Snapdragon 845     | 2018-10-01   | O      |      430 |     0.010% |
| 398  | raphael          | Xiaomi       | Redmi K20 Pro, Mi 9T Pro  | Snapdragon 855     | 2019-08-20   | U      |      429 |     0.010% |
| 399  | sheldon          | Amazon       | Fire TV Stick Lite, Fire… | MediaTek MT8695D   | 2020-09-30   | U      |      427 |     0.010% |
| 399  | kirin            | Sony         | Xperia 10                 | Snapdragon 630     | 2019-02-01   | O      |      427 |     0.010% |
| 401  | d1               | Samsung      | Galaxy Note10             | Exynos 9825        | 2019-08-23   | O      |      426 |     0.010% |
| 402  | cannon           | Xiaomi       | Redmi Note 9 5G, Redmi N… | Dimensity 800U     | 2020-12-01   | U      |      425 |     0.010% |
| 403  | gtanotexllte     | Samsung      | Galaxy Tab A 10.1 (2016)… | Exynos 7870 Octa   | 2016-05-01   | U      |      419 |     0.010% |
| 403  | gta2xlwifi       | Samsung      | Galaxy Tab A 10.5 (2018)… | Snapdragon 450     | 2018-08-01   | U      |      419 |     0.010% |
| 405  | TB8704           | Lenovo       | Tab 4 8 Plus (Wi-Fi)      | Snapdragon 625     | 2017-07-01   | U      |      418 |     0.010% |
| 406  | m7               | HTC          | One (GSM)                 | Snapdragon 600     | 2013-03-01   | D      |      417 |     0.010% |
| 407  | pdx203           | Sony         | Xperia 1 II               | Snapdragon 865     | 2020-05-01   | O      |      416 |     0.010% |
| 408  | xpeng            | Motorola     | moto g200 5G, Edge S30    | Snapdragon 888+    | 2021-11-01   | O      |      415 |     0.010% |
| 408  | titan            | Motorola     | moto g (2014)             | Snapdragon 400     | 2014-06-01   | D      |      415 |     0.010% |
| 410  | j5nlte           | Samsung      | Galaxy J5 (2015) (SM-J50… | Snapdragon 410     | 2015-07-28   | U      |      414 |     0.010% |
| 411  | hawao            | Motorola     | moto g42                  | Snapdragon 680 4G  | 2022-06-01   | O      |      410 |     0.009% |
| 411  | Mi439_4_19       | Xiaomi       | Redmi 8A                  | Snapdragon 439     | 2019-10-01   | U      |      410 |     0.009% |
| 413  | a72q             | Samsung      | Galaxy A72                | Snapdragon 720G    | 2021-03-26   | O      |      408 |     0.009% |
| 414  | tucana           | Xiaomi       | Mi Note 10, Mi Note 10 P… | Snapdragon 730G    | 2019-11-11   | O      |      407 |     0.009% |
| 415  | oxygen           | Xiaomi       | Mi Max 2                  | Snapdragon 625     | 2017-06-01   | U      |      406 |     0.009% |
| 416  | selene           | Xiaomi       | Redmi 10                  | Helio G88          | 2021-08-20   | U      |      404 |     0.009% |
| 416  | capricorn        | Xiaomi       | Mi 5s                     | Snapdragon 821     | 2016-10-01   | D      |      404 |     0.009% |
| 418  | grandprimeve3g   | Samsung      | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |      399 |     0.009% |
| 418  | fuxi             | Xiaomi       | Xiaomi 13                 | Snapdragon 8 Gen2  | 2022-12-11   | O      |      399 |     0.009% |
| 420  | j53gxx           | Samsung      | Galaxy J5 (2015)          | Snapdragon 410     | 2015-07-28   | U      |      396 |     0.009% |
| 421  | stone            | Xiaomi       | Redmi Note 12, Redmi Not… | Snapdragon 4 Gen 1 | 2023-01-11   | U      |      395 |     0.009% |
| 421  | camellia         | Xiaomi       | Redmi Note 10T, Redmi No… | Dimensity 700      | 2021-07-26   | U      |      395 |     0.009% |
| 423  | kminilte         | Samsung      | Galaxy S5 Mini            | Exynos 3470 Quad   | 2014-07-01   | U      |      390 |     0.009% |
| 424  | pollux_windy     | Sony         | Xperia Tablet Z Wi-Fi     | Snapdragon S4 Pro  | 2013-02-01   | D      |      387 |     0.009% |
| 424  | lemonades        | OnePlus      | OnePlus 9R                | Snapdragon 888     | 2021-03-01   | O      |      387 |     0.009% |
| 426  | riva             | Xiaomi       | Redmi 5A                  | Snapdragon 425     | 2017-12-01   | U      |      385 |     0.009% |
| 427  | Pong             | Nothing      | Phone (2)                 | Snapdragon 8+ Gen1 | 2023-07-11   | O      |      383 |     0.009% |
| 428  | waydroid_arm64_… | virtual      | Waydroid ARM64            | ARM64              |              | U      |      382 |     0.009% |
| 429  | x1q              | Samsung      | Galaxy S20                | Exynos 990         | 2020-03-06   | U      |      379 |     0.009% |
| 429  | v1a3g            | Samsung      | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-01   | U      |      379 |     0.009% |
| 431  | sumire           | Sony         | Xperia Z5                 | Snapdragon 810     | 2015-09-01   | D      |      378 |     0.009% |
| 432  | surnia           | Motorola     | moto e LTE (2015)         | Snapdragon 410     | 2015-02-01   | D      |      377 |     0.009% |
| 432  | judyln           | LG           | G7 ThinQ (G710AWM/EM/EMW… | Snapdragon 845     | 2018-05-02   | O      |      377 |     0.009% |
| 434  | TB8504           | Lenovo       | Tab4 8, Tab 4 8           | Snapdragon 425     | 2017-09-15   | U      |      375 |     0.009% |
| 435  | trelteskt        | Samsung      | Galaxy Note 4 (N910S/L/K) | Snapdragon 805     | 2014-10-01   | U      |      373 |     0.009% |
| 436  | zenlte           | Samsung      | Galaxy S6 Edge+           | Exynos 7420 Octa   | 2015-08-01   | U      |      372 |     0.009% |
| 436  | nairo            | Motorola     | moto g 5G plus, moto one… | Snapdragon 662     | 2021-01-01   | O      |      372 |     0.009% |
| 438  | veux             | Xiaomi       | POCO X4 Pro 5G            | Snapdragon 695 5G  | 2022-03-23   | U      |      367 |     0.008% |
| 439  | markw            | Xiaomi       | Redmi 4 Prime             | Snapdragon 625     | 2016-11-01   | U      |      366 |     0.008% |
| 440  | wt88047          | Wingtech     | Redmi 2                   | Snapdragon 410     | 2015-01-01   | D      |      365 |     0.008% |
| 441  | rtwo             | Motorola     | edge 40 pro, moto X40 ed… | Snapdragon 8 Gen2  | 2023-04-01   | O      |      362 |     0.008% |
| 442  | zeus             | Xiaomi       | Xiaomi 12 Pro             | Snapdragon 8 Gen1  | 2021-12-31   | O      |      361 |     0.008% |
| 443  | mondrianlte      | Samsung      | Galaxy Tab Pro 8.4 LTE (… | Snapdragon 800     | 2014-03-01   | U      |      360 |     0.008% |
| 444  | duchamp          | Xiaomi       | Redmi K70E, Poco X6 Pro … | Dimensity 8300 Ul… | 2023-11-29   | U      |      359 |     0.008% |
| 445  | cebu             | Motorola     | moto g9 power, K12 Pro    | Snapdragon 662     | 2020-11-01   | O      |      357 |     0.008% |
| 446  | s3ve3gxx         | Samsung      | Galaxy S III Neo (Sony C… | Snapdragon 400     | 2014-04-11   | D      |      352 |     0.008% |
| 447  | gt510lte         | Samsung      | Galaxy Tab A 9.7 (SM-T55… | Snapdragon 410     | 2015-05-01   | U      |      351 |     0.008% |
| 448  | discovery        | Sony         | Xperia XA2 Ultra          | Snapdragon 630     | 2018-02-01   | O      |      350 |     0.008% |
| 449  | zl1              | LeEco        | Le Pro3, Le Pro3 Elite    | Snapdragon 821     | 2016-10-01   | D      |      349 |     0.008% |
| 450  | gt5note10wifi    | Samsung      | Galaxy Tab A 9.7 Wi-Fi (… | Snapdragon 410     | 2015-05-01   | U      |      348 |     0.008% |
| 450  | DRG              | Nokia        | Nokia 6.1 Plus            | Snapdragon 636     | 2018-08-30   | D      |      348 |     0.008% |
| 452  | borneo           | Motorola     | moto g power 2021         | Snapdragon 662     | 2021-01-01   | O      |      346 |     0.008% |
| 453  | pdx214           | Sony         | Xperia 5 III              | Snapdragon 888     | 2021-04-01   | O      |      343 |     0.008% |
| 453  | RM6785           | Realme       | 6, 6i, 6s, Narzo, 7, Nar… | Mediatek MT6785    | 2020-03-11   | U      |      343 |     0.008% |
| 455  | timelm           | LG           | V60 ThinQ 5G              | Snapdragon 865 5G  | 2020-03-20   | U      |      341 |     0.008% |
| 456  | tangorpro        | Google       | Pixel Tablet              | Tensor GS201       | 2023-06-10   | O      |      339 |     0.008% |
| 456  | castor_windy     | Sony         | Xperia Tablet Z2 Wi-Fi    | Snapdragon 801     | 2014-03-26   | D      |      339 |     0.008% |
| 456  | R9s              | OPPO         | R9s, R9sk                 | Snapdragon 625     | 2016-10-01   | U      |      339 |     0.008% |
| 459  | z3tcw            | Sony         | Xperia Z3 Tablet Compact… | Snapdragon 801     | 2014-11-01   | U      |      336 |     0.008% |
| 460  | z2_plus          | ZUK          | Z2 Plus                   | Snapdragon 820     | 2016-06-01   | D      |      334 |     0.008% |
| 461  | guam             | Motorola     | moto e7 plus, K12         | Snapdragon 460     | 2020-09-16   | O      |      333 |     0.008% |
| 462  | Z01R             | ASUS         | Zenfone 5Z (ZS620KL)      | Snapdragon 845     | 2018-06-01   | O      |      328 |     0.008% |
| 463  | hltetmo          | Samsung      | Galaxy Note 3 LTE (N900T… | Snapdragon 800     | 2013-09-01   | D      |      327 |     0.008% |
| 464  | diting           | Xiaomi       | Xiaomi 12T Pro, Redmi K5… | Snapdragon 8+ Gen1 | 2022-10-06   | O      |      324 |     0.007% |
| 464  | bardockpro       | BQ           | Aquaris X Pro             | Snapdragon 626     | 2017-06-01   | D      |      324 |     0.007% |
| 466  | komodo           | Google       | Pixel 9 Pro XL            | Tensor G4          | 2024-08-22   | O      |      322 |     0.007% |
| 467  | hanoip           | Motorola     | Moto G60, Moto G40 Fusion | Snapdragon 732G    | 2021-04-27   | U      |      321 |     0.007% |
| 468  | karin            | Sony         | Xperia Z4 Tablet LTE      | Snapdragon 810     | 2015-10-01   | D      |      317 |     0.007% |
| 469  | TBX304           | Lenovo       | Tab4 8, Tab4 10 WIFI      | Qualcomm APQ8017   | 2017-07-01   | U      |      316 |     0.007% |
| 470  | hltedcm          | Samsung      | Galaxy Note 3 (Docomo SC… | Snapdragon 800     | 2013-09-01   | U      |      315 |     0.007% |
| 471  | maple            | Sony         | Xperia XZ Premium         | Snapdragon 835     | 2017-06-18   | U      |      311 |     0.007% |
| 472  | dragon           | Google       | Pixel C                   | Tegra X1 (T210)    | 2015-12-08   | D      |      310 |     0.007% |
| 473  | suzuran          | Sony         | Xperia Z5 Compact         | Snapdragon 810     | 2015-10-01   | D      |      308 |     0.007% |
| 474  | miami            | Motorola     | edge 30 neo               | Snapdragon 695     | 2022-10-07   | O      |      306 |     0.007% |
| 475  | pdx234           | Sony         | Xperia 1 V                | Snapdragon 8 Gen2  | 2023-05-01   | O      |      305 |     0.007% |
| 475  | d802             | LG           | G2 (International)        | Snapdragon 800     | 2013-09-12   | D      |      305 |     0.007% |
| 475  | a5lte            | Samsung      | Galaxy A5 (A500F)         | Snapdragon 410     | 2014-12-01   | U      |      305 |     0.007% |
| 478  | phoenix          | Xiaomi       | Redmi K30                 | Snapdragon 730G    | 2019-12-01   | U      |      304 |     0.007% |
| 479  | zenfone3         | ASUS         | Zenfone 3                 | Snapdragon 625     | 2016-05-30   | D      |      301 |     0.007% |
| 479  | v2awifi          | Samsung      | Galaxy Tab Pro 12.2 WiFi  | Exynos 5420 Octa   | 2014-03-01   | U      |      301 |     0.007% |
| 479  | suzu             | Sony         | Xperia X                  | Snapdragon 650     | 2016-05-01   | D      |      301 |     0.007% |
| 479  | shieldtablet     | NVIDIA       | Shield Tablet             | Tegra K1 (T124)    | 2014-07-29   | D      |      301 |     0.007% |
| 483  | beckham          | Motorola     | moto z3 play              | Snapdragon 636     | 2018-06-01   | O      |      300 |     0.007% |
| 484  | santos10lte      | Samsung      | Galaxy Tab 3 10.1 LTE (G… | Atom Z2560         | 2013-07-07   | U      |      299 |     0.007% |
| 485  | dodge            | OnePlus      | 13                        | Snapdragon 8 Elite | 2024-11-01   | O      |      297 |     0.007% |
| 486  | ocn              | HTC          | U11                       | Snapdragon 835     | 2017-06-10   | U      |      296 |     0.007% |
| 487  | manta            | Google       | Nexus 10                  | Exynos 5250        | 2012-11-13   | D      |      295 |     0.007% |
| 488  | gts28velte       | Samsung      | Galaxy Tab S2 8.0 (T719)  | Snapdragon 652     | 2016-07-01   | U      |      294 |     0.007% |
| 489  | j6lte            | Samsung      | Galaxy J6                 | Exynos 7870        | 2018-05-01   | U      |      292 |     0.007% |
| 490  | m52xq            | Samsung      | Galaxy M52 5G             | Snapdragon 778G 5G | 2021-10-03   | O      |      291 |     0.007% |
| 491  | spaced           |              |                           |                    |              | U      |      286 |     0.007% |
| 492  | martini          | OnePlus      | OnePlus 9RT               | Snapdragon 888     | 2021-10-01   | O      |      285 |     0.007% |
| 493  | checkers         | Amazon       | Echo Show 5               | MediaTek MT8163    | 2019-06-01   | U      |      284 |     0.007% |
| 494  | aston            | OnePlus      | OnePlus 12R               | Snapdragon 8 Gen2  | 2024-01-01   | O      |      283 |     0.007% |
| 495  | a73xq            | Samsung      | Galaxy A73 5G             | Snapdragon 778G 5G | 2022-04-22   | O      |      282 |     0.007% |
| 496  | klteduos         | Samsung      | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-06-01   | D      |      281 |     0.006% |
| 497  | castor           | Sony         | Xperia Tablet Z2 LTE      | Snapdragon 801     | 2014-03-26   | D      |      280 |     0.006% |
| 498  | kltekor          | Samsung      | Galaxy S5 LTE (G900K/L/S) | Snapdragon 801     | 2014-04-01   | D      |      276 |     0.006% |
| 498  | j5y17lte         | Samsung      | Galaxy J5 (2017) (SM-J53… | Exynos 7870 Octa   | 2017-06-01   | U      |      276 |     0.006% |
| 500  | sakura           | Xiaomi       | Redmi 6 Pro, Mi A2 Lite   | Snapdragon 625     | 2018-07-01   | U      |      275 |     0.006% |
| 500  | n8000_deodexed   | Samsung      | Galaxy Note 10.1 3G (GT-… | Exynos 4412 Quad   | 2012-08-01   | U      |      275 |     0.006% |
| 500  | YTX703L          | Lenovo       | Yoga Tab 3 Plus LTE       | Snapdragon 652     | 2016-12-01   | D      |      275 |     0.006% |
| 503  | sunny            | Xiaomi       | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |      271 |     0.006% |
| 504  | serranovelte     | Samsung      | Galaxy S4 Mini (GT-I9195… | Snapdragon 410     | 2015-06-01   | U      |      269 |     0.006% |
| 504  | m23xq            | Samsung      | Galaxy M23, Galaxy F23 5G | Snapdragon 750G 5G | 2022-04-08   | U      |      269 |     0.006% |
| 504  | judypn           | LG           | V40 ThinQ                 | Snapdragon 845     | 2018-10-03   | O      |      269 |     0.006% |
| 507  | hltechn          | Samsung      | Galaxy Note 3 LTE (N9008… | Snapdragon 800     | 2013-09-01   | D      |      268 |     0.006% |
| 508  | m31              | Samsung      | Galaxy M31                | Exynos 9611        | 2020-03-05   | U      |      263 |     0.006% |
| 509  | lava             | Xiaomi       | Redmi 9, Poco M2          | Helio G80          | 2020-06-10   | U      |      262 |     0.006% |
| 510  | oscaro           | OnePlus      | OnePlus Nord CE 2 Lite 5G | Snapdragon 695     | 2022-04-30   | O      |      260 |     0.006% |
| 510  | dm1q             | Samsung      | Galaxy S23                | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      260 |     0.006% |
| 512  | picassolte       | Samsung      | Galaxy Tab Pro 10.1 LTE … | Snapdragon 800     | 2014-03-01   | U      |      259 |     0.006% |
| 513  | milletlte        | Samsung      | Galaxy Tab4 8.0 LTE (SM-… | Snapdragon 400     | 2014-06-01   | U      |      258 |     0.006% |
| 514  | rhodep           | Motorola     | moto g82 5G               | Snapdragon 695     | 2022-06-07   | O      |      257 |     0.006% |
| 514  | r8s              | Samsung      | Galaxy S20 FE (SM-G780F)  | Exynos 990         | 2020-10-02   | U      |      257 |     0.006% |
| 516  | pstar            | Motorola     | edge 20 pro               | Snapdragon 870     | 2021-08-01   | O      |      255 |     0.006% |
| 516  | kiwi             | Huawei       | Honor 5X                  | Snapdragon 616     | 2015-11-01   | D      |      255 |     0.006% |
| 516  | caiman           | Google       | Pixel 9 Pro               | Tensor G4          | 2024-09-09   | O      |      255 |     0.006% |
| 516  | a40              | Samsung      | Galaxy A40                | Exynos 7904        | 2019-04-01   | U      |      255 |     0.006% |
| 520  | z3               | Sony         | Xperia Z3                 | Snapdragon 801     | 2014-09-04   | D      |      254 |     0.006% |
| 520  | pollux           | Sony         | Xperia Tablet Z LTE       | Snapdragon S4 Pro  | 2013-02-01   | D      |      254 |     0.006% |
| 522  | gvwifi           | Samsung      | Galaxy View WiFi (SM-T67… | Exynos 7580 Octa   | 2015-11-01   | U      |      252 |     0.006% |
| 523  | nitrogen         | Xiaomi       | Mi MAX 3                  | Snapdragon 636     | 2018-07-01   | U      |      250 |     0.006% |
| 524  | alphaplus        | LG           | G8 ThinQ, G8 ThinQ (Kore… | Snapdragon 855     | 2019-02-01   | O      |      249 |     0.006% |
| 524  | a505fn           | Samsung      | Galaxy A50 (SM-A505FN)    | Exynos 9610        | 2019-03-18   | U      |      249 |     0.006% |
| 526  | sky              | Xiaomi       | Redmi 12, POCO M6 Pro 5G  | Snapdragon 4 Gen 2 | 2023-08-04   | U      |      247 |     0.006% |
| 527  | racer            | Motorola     | edge                      | Snapdragon 765G    | 2020-05-01   | O      |      246 |     0.006% |
| 527  | bardock          | BQ           | Aquaris X                 | Snapdragon 626     | 2017-06-01   | D      |      246 |     0.006% |
| 529  | land             | Xiaomi       | Redmi 3S, Redmi 3X        | Snapdragon 430     | 2016-06-01   | D      |      242 |     0.006% |
| 530  | ovaltine         | OnePlus      | 10T 5G                    | Snapdragon 8+ Gen… | 2022-08-06   | U      |      236 |     0.005% |
| 531  | kltedv           | Samsung      | Galaxy S5 LTE (G900I/P)   | Snapdragon 801     | 2014-04-01   | D      |      234 |     0.005% |
| 532  | apollo           | Xiaomi       | Mi 10T 5G, Mi 10T Pro, R… | Snapdragon 865 5G  | 2020-10-13   | U      |      233 |     0.005% |
| 533  | d855             | LG           | G3 (International)        | Snapdragon 801     | 2014-06-01   | D      |      231 |     0.005% |
| 534  | pine             | Xiaomi       | Redmi 7A                  | Snapdragon 439     | 2019-07-04   | U      |      228 |     0.005% |
| 535  | r9s              | OPPO         | R9s                       | Snapdragon 625     | 2016-10-01   | U      |      223 |     0.005% |
| 536  | grandprimevelte  | Samsung      | Galaxy Grand Prime VE LTE | Marvell PXA1908    | 2015-07-29   | U      |      222 |     0.005% |
| 537  | togari           | Sony         | Xperia Z Ultra            | Snapdragon 800     | 2013-07-01   | U      |      221 |     0.005% |
| 537  | oce              | HTC          | U Ultra, Ocean Note       | Snapdragon 821     | 2017-02-21   | U      |      221 |     0.005% |
| 539  | poplar           | Sony         | Xperia XZ1 (G8341)        | Snapdragon 835     | 2017-09-19   | U      |      220 |     0.005% |
| 540  | sirius           | Sony         | Xperia Z2                 | Snapdragon 801     | 2014-04-01   | D      |      218 |     0.005% |
| 540  | FP2              | Fairphone    | Fairphone 2               | Snapdragon 801     | 2015-12-01   | D      |      218 |     0.005% |
| 542  | RMX2185          | Realme       | C11                       | Helio G35          | 2020-07-07   | U      |      216 |     0.005% |
| 543  | virtio_arm64only | virtual      |                           | ARM64              |              | U      |      214 |     0.005% |
| 543  | venus            | Xiaomi       | Mi 11                     | Snapdragon 888 5G  | 2021-01-01   | U      |      214 |     0.005% |
| 545  | mako             | Google       | Nexus 4                   | Snapdragon S4 Pro  | 2012-11-13   | D      |      213 |     0.005% |
| 546  | amami            | Sony         | Xperia Z1 compact         | Snapdragon 800     | 2014-01-01   | U      |      212 |     0.005% |
| 546  | A102             | Micromax     | Canvas Doodle 3 (A102)    | Mediatek MT6572    | 2014-04-01   | U      |      212 |     0.005% |
| 548  | sea              | Xiaomi       | Redmi Note 12S            | Helio G96 (12 nm)  | 2023-04-26   | U      |      210 |     0.005% |
| 548  | X00T             | ASUS         | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | U      |      210 |     0.005% |
| 550  | gt5note10lte     | Samsung      | Galaxy Tab A 9.7 LTE (SM… | Snapdragon 410     | 2015-06-01   | U      |      209 |     0.005% |
| 551  | TB2-X30L         | Lenovo       | TAB 2 A10-30 (TB2-X30L)   | Snapdragon 210     | 2015-10-29   | U      |      208 |     0.005% |
| 552  | z3tc             | Sony         | Xperia Z3 Tablet Compact  | Snapdragon 801     | 2014-11-01   | U      |      206 |     0.005% |
| 552  | sapphire         | Xiaomi       | Redmi Note 13 4G, Redmi … | Snapdragon 685     | 2024-01-15   | U      |      206 |     0.005% |
| 552  | giza             | Amazon       | Fire HD 8 7/6th gen (KFG… | MediaTek MT8163V/B | 2016-09-21   | U      |      206 |     0.005% |
| 552  | beethoven        | Huawei       | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      206 |     0.005% |
| 552  | addison          | Motorola     | moto z play               | Snapdragon 625     | 2016-09-01   | D      |      206 |     0.005% |
| 557  | capri            | Motorola     | moto g10, moto g10 power… | Snapdragon 460     | 2021-02-01   | O      |      204 |     0.005% |
| 558  | xun              | Xiaomi       | Redmi Pad SE              | Snapdragon 680 4G  | 2023-09-01   | U      |      202 |     0.005% |
| 558  | p3s              |              |                           |                    |              | U      |      202 |     0.005% |
| 558  | amar_row_lte     | Lenovo       | Tab M10 HD (2nd Gen)      | Helio P22T         | 2020-11-01   | U      |      202 |     0.005% |
| 561  | pdx235           | Sony         | Xperia 10 V               | Snapdragon 695     | 2023-06-21   | O      |      201 |     0.005% |
| 561  | ariel            | Amazon       | Fire HD 6/7               | MediaTek MT8135V   | 2014-10-02   | U      |      201 |     0.005% |
| 563  | griffin          | Motorola     | moto z                    | Snapdragon 820     | 2016-09-01   | D      |      200 |     0.005% |
| 564  | tanzanite        | Xiaomi       | Redmi Note 14 4G          | Helio G99 Ultra    | 2025-01-15   | U      |      199 |     0.005% |
| 564  | pipa             | Xiaomi       | Pad 6                     | Snapdragon 870 5G  | 2023-04-18   | U      |      199 |     0.005% |
| 566  | btvdl09          | Huawei       | Mediapad M3 8.4 (BTV-DL0… | Kirin 950          | 2016-10-01   | U      |      198 |     0.005% |
| 566  | a53x             | Samsung      | Galaxy A53 5G             | Exynos 1280 (5 nm) | 2022-03-24   | U      |      198 |     0.005% |
| 568  | btv              | Huawei       | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      197 |     0.005% |
| 569  | dm3q             | Samsung      | Galaxy S23 Ultra          | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      194 |     0.004% |
| 570  | z3c              | Sony         | Xperia Z3 Compact         | Snapdragon 801     | 2014-09-04   | D      |      193 |     0.004% |
| 570  | honami           | Sony         | Xperia Z1 (C6903)         | Snapdragon 800     | 2013-09-01   | U      |      193 |     0.004% |
| 572  | socrates         | Xiaomi       | Redmi K60 Pro             | Snapdragon 8 Gen2  | 2022-12-27   | O      |      192 |     0.004% |
| 572  | o1s              | Samsung      | Galaxy S21 5G (SM-G991B/… | Exynos 2100        | 2021-01-29   | U      |      192 |     0.004% |
| 574  | thyme            | Xiaomi       | Mi 10S                    | Snapdragon 870     | 2021-03-01   | O      |      191 |     0.004% |
| 574  | tblte            | Samsung      | Galaxy Note Edge (SM-N91… | Snapdragon 805     | 2014-11-01   | U      |      191 |     0.004% |
| 576  | degaslte         | Samsung      | Galaxy Tab 4 7.0 LTE, Ga… | Exynos 3470 Quad   | 2014-05-01   | U      |      190 |     0.004% |
| 576  | a54x             | Samsung      | Galaxy A54 5G             | Exynos 1380        | 2023-03-24   | U      |      190 |     0.004% |
| 576  | NB1              | Nokia        | Nokia 8                   | Snapdragon 835     | 2017-08-16   | O      |      190 |     0.004% |
| 579  | lux              | Motorola     | moto x play               | Snapdragon 615     | 2015-08-01   | D      |      189 |     0.004% |
| 579  | beyond1          | Samsung      | Galaxy S10                | Exynos 9820        | 2019-03-08   | U      |      189 |     0.004% |
| 581  | pdx225           | Sony         | Xperia 10 IV              | Snapdragon 695     | 2022-06-30   | O      |      188 |     0.004% |
| 582  | elish            | Xiaomi       | Pad 5 Pro Wi-Fi           | Snapdragon 870 5G  | 2021-08-10   | U      |      187 |     0.004% |
| 583  | tundra           | Motorola     | edge 30 fusion            | Snapdragon 888+    | 2022-09-01   | O      |      186 |     0.004% |
| 584  | nabu             | Xiaomi       | Pad 5                     | Snapdragon 860     | 2021-08-10   | U      |      185 |     0.004% |
| 584  | js01lte          | Samsung      | Galaxy J (Docomo SC-02F)  | Snapdragon 800     | 2013-12-01   | U      |      185 |     0.004% |
| 584  | RMX1821          | Realme       | 3 (RMX1821)               | Helio P60          | 2019-03-01   | U      |      185 |     0.004% |
| 587  | giulia           | OnePlus      | 13R, Ace 5                | Snapdragon 8 Gen 3 | 2025-01-14   | U      |      184 |     0.004% |
| 588  | cheryl           | Razer        | Phone                     | Snapdragon 835     | 2017-11-01   | O      |      183 |     0.004% |
| 589  | odroidxu3        | HardKernel   | ODROID-XU3                | Exynos 5422        | 2014-08-18   | U      |      182 |     0.004% |
| 590  | monet            | Xiaomi       | Mi 10 Lite 5G             | Snapdragon 765G    | 2020-05-01   | D      |      181 |     0.004% |
| 590  | flounder         | Google       | Nexus 9 (Wi-Fi)           | Tegra K1 (T124)    | 2014-11-03   | D      |      181 |     0.004% |
| 592  | tre3calteskt     | Samsung      | Galaxy Note 4 (N916S/L/K) | Exynos 5433        | 2014-10-01   | U      |      180 |     0.004% |
| 593  | v500             | LG           | G Pad 8.3                 | Snapdragon 600     | 2013-10-14   | D      |      179 |     0.004% |
| 594  | i9305            | Samsung      | Galaxy S III (LTE / Inte… | Exynos 4412        | 2012-10-01   | D      |      177 |     0.004% |
| 594  | curtana          | Xiaomi       | Redmi Note 9S, Redmi Not… | Snapdragon 720G    | 2020-04-30   | U      |      177 |     0.004% |
| 596  | z3s              | Samsung      | Galaxy S20 Ultra (5G)     | Exynos 990         | 2020-03-06   | O      |      175 |     0.004% |
| 596  | rodin            | Xiaomi       | Poco X7 Pro               | Dimensity 8400 Ul… | 2025-01-09   | U      |      175 |     0.004% |
| 596  | q5q              | Samsung      | Galaxy Z Fold 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      175 |     0.004% |
| 599  | X01BD            | ASUS         | Zenfone Max Pro M2        | Snapdragon 660     | 2018-12-01   | D      |      174 |     0.004% |
| 600  | j1acevelte       | Samsung      | Galaxy J1 Ace VE, Galaxy… | Spreadtrum SC9830  | 2016-07-11   | U      |      173 |     0.004% |
| 601  | pme              | HTC          | HTC 10                    | Snapdragon 820     | 2016-05-01   | D      |      172 |     0.004% |
| 601  | odin             | Sony         | Xperia ZL                 | Snapdragon S4 Pro  | 2013-03-01   | D      |      172 |     0.004% |
| 601  | meliusltexx      | Samsung      | Galaxy Mega 6.3           | Snapdragon 400     | 2013-06-01   | U      |      172 |     0.004% |
| 601  | kagura           | Sony         | Xperia XZ Dual (F8332)    | Snapdragon 820     | 2016-10-03   | U      |      172 |     0.004% |
| 605  | xaga             | Xiaomi       | POCO X4 GT                | Dimensity 8100     | 2022-06-27   | U      |      171 |     0.004% |
| 606  | victara          | Motorola     | moto x (2014)             | Snapdragon 801     | 2014-09-26   | D      |      169 |     0.004% |
| 607  | chopin           | Xiaomi       | Redmi Note 10 PRO 5G      | Snapdragon 732G    | 2021-03-24   | U      |      168 |     0.004% |
| 607  | avalon           | OnePlus      | Nord 4                    | Snapdragon 7+ Gen… | 2024-07-01   | O      |      168 |     0.004% |
| 609  | b2q              | Samsung      | Galaxy Z Flip3 5G         | Snapdragon 888 5G  | 2021-08-27   | U      |      167 |     0.004% |
| 610  | j1xlte           | Samsung      | Galaxy J1 (2016) (SM-J12… | Spreadtrum SC9830  | 2016-01-01   | U      |      166 |     0.004% |
| 611  | crackling        | Wileyfox     | Swift                     | Snapdragon 410     | 2015-10-01   | D      |      165 |     0.004% |
| 612  | sake             | ASUS         | ZenFone 8                 | Snapdragon 888     | 2021-05-01   | O      |      163 |     0.004% |
| 612  | poplar_dsds      | Sony         | Xperia XZ1 Dual (F8342)   | Snapdragon 835     | 2017-09-19   | U      |      163 |     0.004% |
| 612  | odroidc4         | HardKernel   | ODROID-C4 (Android TV)    | Amlogic S905X3     | 2020-12-01   | O      |      163 |     0.004% |
| 612  | TB8703N          | Lenovo       | Tab3 8 plus               | Snapdragon 625     | 2017-03-01   | U      |      163 |     0.004% |
| 616  | b5q              | Samsung      | Galaxy Z Flip 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      162 |     0.004% |
| 617  | ja3gxx           | Samsung      | Galaxy S4 (I9500)         | Exynos 5410 Octa   | 2013-04-01   | U      |      161 |     0.004% |
| 617  | hima             | HTC          | One M9                    | Snapdragon 810     | 2015-03-09   | U      |      161 |     0.004% |
| 619  | yuga             | Sony         | Xperia Z                  | Snapdragon S4 Pro  | 2013-02-01   | D      |      160 |     0.004% |
| 619  | gts7l            | Samsung      | Galaxy Tab S7 (LTE)       | Snapdragon 865+    | 2020-08-21   | O      |      160 |     0.004% |
| 619  | a5ultexx         | Samsung      | Galaxy A5 (A500FU)        | Snapdragon 410     | 2014-12-01   | U      |      160 |     0.004% |
| 622  | quill            | NVIDIA       | Jetson TX2 [Android TV],… | Tegra X2 (T186)    | 2017-03-14   | O      |      159 |     0.004% |
| 622  | n7000            | Samsung      | Galaxy Note N7000         | Exynos 4210 Dual   | 2011-10-01   | U      |      159 |     0.004% |
| 622  | gt58ltebmc       | Samsung      | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |      159 |     0.004% |
| 622  | a05m             |              |                           |                    |              | U      |      159 |     0.004% |
| 626  | r5x              |              |                           |                    |              | U      |      157 |     0.004% |
| 626  | a32              | Samsung      | Galaxy A32 4G             | Helio G80 (12 nm)  | 2021-02-25   | U      |      157 |     0.004% |
| 628  | sweet2           | Xiaomi       | Redmi Note 12 Pro         | Dimensity 1080     | 2022-11-01   | U      |      156 |     0.004% |
| 628  | m21              | Samsung      | Galaxy M21                | Exynos 9611        | 2020-03-23   | U      |      156 |     0.004% |
| 628  | f62              | Samsung      | Galaxy F62, Galaxy M62    | Exynos 9825        | 2021-02-22   | O      |      156 |     0.004% |
| 631  | vivalto3mveml3g  | Samsung      | Galaxy Ace 4 Neo (SM-G31… | Spreadtrum SC8830  | 2014-08-01   | U      |      154 |     0.004% |
| 631  | j4corelte        | Samsung      | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |      154 |     0.004% |
| 631  | RMX1931          | Realme       | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |      154 |     0.004% |
| 634  | pro1x            | F(x)tec      | Pro¹ X                    | Snapdragon 662     | 2022-12-01   | O      |      153 |     0.004% |
| 634  | goyavewifi       | Samsung      | Galaxy Tab E 7” (SM-T113… | Spreadtrum SC8830  | 2015-03-01   | U      |      153 |     0.004% |
| 636  | nuwa             | Xiaomi       | Xiaomi 13 Pro             | Snapdragon 8 Gen2  | 2022-12-11   | O      |      152 |     0.004% |
| 636  | mermaid          | Sony         | Xperia 10 Plus            | Snapdragon 636     | 2019-02-01   | O      |      152 |     0.004% |
| 636  | ham              | ZUK          | Z1                        | Snapdragon 801     | 2015-10-14   | D      |      152 |     0.004% |
| 639  | ss2              | Sharp        | Aquos S2                  | Snapdragon 630 an… | 2017-08-01   | U      |      150 |     0.003% |
| 640  | tapas            | Xiaomi       | Redmi Note 12 4G          | Snapdragon 685     | 2023-03-30   | U      |      149 |     0.003% |
| 640  | erhai            | OnePlus      | OnePlus Pad 2 Pro, OnePl… | Snapdragon 8 Elite | 2025-05-01   | O      |      149 |     0.003% |
| 642  | vili             | Xiaomi       | 11T Pro                   | Snapdragon 888 5G  | 2021-10-05   | U      |      148 |     0.003% |
| 642  | vermeer          | Xiaomi       | POCO F6 Pro               | Snapdragon 8 Gen2  | 2024-05-28   | O      |      148 |     0.003% |
| 642  | karate           | Lenovo       | K6 Power                  | Snapdragon 430     | 2016-11-01   | U      |      148 |     0.003% |
| 645  | voyager          | Sony         | Xperia XA2 Plus           | Snapdragon 630     | 2018-07-01   | O      |      146 |     0.003% |
| 645  | t2s              |              |                           |                    |              | U      |      146 |     0.003% |
| 647  | courbet          | Xiaomi       | Mi 11 Lite 4G             | Snapdragon 732G    | 2021-04-16   | U      |      145 |     0.003% |
| 648  | s3ve3g           | Samsung      | Galaxy S3 Neo             | Snapdragon 400     | 2014-04-01   | U      |      143 |     0.003% |
| 648  | kltekdi          | Samsung      | Galaxy S5 LTE (SC-04F/SC… | Snapdragon 801     | 2014-05-01   | D      |      143 |     0.003% |
| 648  | Z1               |              |                           |                    |              | U      |      143 |     0.003% |
| 648  | B2N              | Nokia        | Nokia 7 plus              | Snapdragon 660     | 2018-04-30   | O      |      143 |     0.003% |
| 652  | satsuki          | Sony         | Xperia Z5 Premium         | Snapdragon 810     | 2015-11-05   | U      |      142 |     0.003% |
| 652  | b0q              |              |                           |                    |              | U      |      142 |     0.003% |
| 654  | RMX2020          | Realme       | C3                        | Helio G70          | 2020-02-14   | U      |      139 |     0.003% |
| 655  | q2q              |              |                           |                    |              | U      |      138 |     0.003% |
| 655  | pdx237           | Sony         | Xperia 5 V                | Snapdragon 8 Gen2  | 2023-09-01   | O      |      138 |     0.003% |
| 655  | hannah           | Motorola     | moto e5 plus (XT1924-6/7… | Snapdragon 435     | 2018-05-01   | D      |      138 |     0.003% |
| 658  | f310p            |              |                           |                    |              | U      |      135 |     0.003% |
| 659  | r7               | OPPO         | R7                        | Snapdragon 615     | 2015-05-01   | U      |      134 |     0.003% |
| 659  | peregrine        | Motorola     | moto g 4G                 | Snapdragon 400     | 2014-06-01   | D      |      134 |     0.003% |
| 661  | milanf           | Motorola     | moto g stylus 5G (2022)   | Snapdragon 695     | 2022-04-27   | O      |      133 |     0.003% |
| 661  | P350             | Samsung      | Galaxy Tab A 8" with S P… | Snapdragon 410     | 2015-05-01   | U      |      133 |     0.003% |
| 663  | a21snsxx         | Samsung      | Galaxy A21s               | Exynos 850 (8 nm)  | 2020-06-02   | U      |      132 |     0.003% |
| 664  | kccat6           | Samsung      | Galaxy S5 Plus            | Snapdragon 805     | 2014-08-21   | D      |      131 |     0.003% |
| 665  | albus            | Motorola     | moto z2 play              | Snapdragon 626     | 2017-06-01   | D      |      130 |     0.003% |
| 665  | a3ltexx          | Samsung      | Galaxy A3 (A300F)         | Snapdragon 410     | 2014-12-01   | U      |      130 |     0.003% |
| 667  | lt02ltespr       | Samsung      | Galaxy Tab 3 7.0 LTE      | Snapdragon 400     | 2016-09-01   | D      |      129 |     0.003% |
| 667  | dopinder         | Walmart      | onn. TV Box 4K (2021)     | Amlogic S905Y2     | 2021-06-01   | O      |      129 |     0.003% |
| 669  | foster_tab       | NVIDIA       | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      128 |     0.003% |
| 670  | jactivelte       | Samsung      | Galaxy S4 Active          | Snapdragon 600     | 2013-06-01   | D      |      127 |     0.003% |
| 670  | dandelion        | Xiaomi       | Redmi 9A                  | Helio G25          | 2020-07-07   | U      |      127 |     0.003% |
| 672  | redwood          | Xiaomi       | Poco X5 Pro               | Snapdragon 778G 5G | 2023-02-07   | U      |      126 |     0.003% |
| 672  | nx659j           | Nubia        | Red Magic 5G (Global), R… | Snapdragon 865     | 2020-03-01   | O      |      126 |     0.003% |
| 672  | marmite          | Wileyfox     | Swift 2, Swift 2 Plus, S… | Snapdragon 430     | 2016-11-01   | U      |      126 |     0.003% |
| 672  | h850             | LG           | G5 (International)        | Snapdragon 820     | 2016-02-01   | D      |      126 |     0.003% |
| 672  | a34x             | Samsung      | Galaxy A34 5G             | Dimensity 1080     | 2023-03-24   | U      |      126 |     0.003% |
| 677  | felix            | Google       | Pixel Fold                | Tensor GS201       | 2023-06-27   | O      |      125 |     0.003% |
| 678  | gta2swifi        | Samsung      | Galaxy Tab A WiFi (SM-T3… | Snapdragon 425     | 2017-09-01   | U      |      124 |     0.003% |
| 678  | fire             |              |                           |                    |              | U      |      124 |     0.003% |
| 680  | n5120            | Samsung      | Galaxy Note 8.0 (LTE)     | Exynos 4412        | 2013-04-01   | D      |      123 |     0.003% |
| 680  | RMP6768          | Realme       | Pad                       | Helio G80          | 2021-09-16   | U      |      123 |     0.003% |
| 682  | FP6              | Fairphone    | 6                         | Snapdragon 7s Gen… | 2025-06-25   | U      |      122 |     0.003% |
| 683  | unicorn          | Xiaomi       | Xiaomi 12S Pro            | Snapdragon 8+ Gen1 | 2022-07-04   | O      |      121 |     0.003% |
| 683  | shark            | Xiaomi       | Black Shark               | Snapdragon 845     | 2018-04-01   | O      |      121 |     0.003% |
| 683  | TBX304F          | Lenovo       | Tab4 10 WiFi (TB-X304F)   | Qualcomm APQ8017   | 2017-07-01   | U      |      121 |     0.003% |
| 686  | x86_64_tablet    |              |                           | x86_64             |              | U      |      120 |     0.003% |
| 686  | bahamut          | Sony         | Xperia 1, Xperia 5        | Snapdragon 855     | 2019-05-30   | U      |      120 |     0.003% |
| 686  | RMX2001L1        | Realme       | 6, 6i (India), 6s, Narzo  | Helio G90T         | 2020-03-11   | U      |      120 |     0.003% |
| 689  | nikel            | Xiaomi       | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | U      |      119 |     0.003% |
| 690  | a9y18qlte        | Samsung      | Galaxy A9 (2018) (SM-A92… | Snapdragon 660     | 2018-11-01   | U      |      118 |     0.003% |
| 691  | debx             | Google       | Nexus 7 2013 (LTE, Repar… | Snapdragon S4 Pro  | 2013-07-26   | D      |      117 |     0.003% |
| 691  | a13              |              |                           |                    |              | U      |      117 |     0.003% |
| 693  | trhpltexx        | Samsung      | Galaxy Note 4 (N910U)     | Exynos 5 Octa 5433 | 2014-10-01   | U      |      116 |     0.003% |
| 693  | RMX1851          | Realme       | Realme 3 Pro              | Snapdragon 710     | 2019-04-29   | D      |      116 |     0.003% |
| 695  | viva             | Xiaomi       | Redmi Note 11 Pro 4G      | Helio G96          | 2022-02-18   | U      |      115 |     0.003% |
| 695  | c2502t_cm8900pl… | C Idea       | CM8900 Plus               | Snapdragon QT615   | 2025-09-24   | U      |      115 |     0.003% |
| 695  | A10-70L          | Lenovo       | Tab 2 LTE (A10-70L)       | Mediatek MT8732    | 2015-04-01   | U      |      115 |     0.003% |
| 698  | toco             | Xiaomi       | Mi Note 10 Lite           | Snapdragon 730G    | 2020-05-09   | U      |      114 |     0.003% |
| 698  | tb128fu          | Lenovo       | Xiaoxin Pad 2022 (TB128F… | Snapdragon 680     | 2022-05-01   | U      |      114 |     0.003% |
| 698  | h990             | LG           | V20 (Global)              | Snapdragon 820     | 2016-10-01   | D      |      114 |     0.003% |
| 698  | denver           | Motorola     | moto g stylus 5G          | Snapdragon 480     | 2021-06-14   | O      |      114 |     0.003% |
| 698  | bouquet          | Xiaomi       | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | U      |      114 |     0.003% |
| 698  | RMX1941          | Realme       | C2                        | Helio P22          | 2019-05-01   | U      |      114 |     0.003% |
| 704  | star2qltesq      | Samsung      | Galaxy S9+ USA (SM-G965U) | Snapdragon 845     | 2018-03-01   | U      |      113 |     0.003% |
| 704  | realme_trinket   | Realme       | 5, 5i, 5s, 5 NFC, 5 Viet… | Snapdragon 665     | 2019-08-01   | U      |      113 |     0.003% |
| 704  | r11s             | OPPO         | R11                       | Snapdragon 660     | 2017-06-01   | U      |      113 |     0.003% |
| 704  | kansas           | Motorola     | moto g (2025), moto g pl… |                    |              | U      |      113 |     0.003% |
| 704  | heart            | Lenovo       | Z5 Pro GT                 | Snapdragon 855     | 2019-01-29   | O      |      113 |     0.003% |
| 709  | trlteduos        | Samsung      | Galaxy Note 4             | Snapdragon 805     | 2014-10-01   | U      |      112 |     0.003% |
| 709  | beyond0          | Samsung      | Galaxy S10e               | Exynos 9820        | 2019-03-08   | U      |      112 |     0.003% |
| 709  | a42xq            | Samsung      | Galaxy A42 5G             | Snapdragon 750 5G  | 2020-11-11   | U      |      112 |     0.003% |
| 712  | btvw09           | Huawei       | Mediapad M3 8.4 (BTV-W09… | Kirin 950          | 2016-10-01   | U      |      111 |     0.003% |
| 713  | karin_windy      | Sony         | Xperia Z4 Tablet WiFi     | Snapdragon 810     | 2015-10-01   | D      |      109 |     0.003% |
| 713  | ingot            | Solana       | Saga                      | Snapdragon 8+ Gen1 | 2023-05-01   | O      |      109 |     0.003% |
| 713  | g0q              |              |                           |                    |              | U      |      109 |     0.003% |
| 713  | bronco           | Motorola     | ThinkPhone by motorola    | Snapdragon 8+ Gen1 | 2023-01-01   | O      |      109 |     0.003% |
| 717  | treble           |              |                           |                    |              | U      |      108 |     0.002% |
| 717  | g710n            | LG           | G7 ThinQ (G710N)          | Snapdragon 845     | 2018-05-02   | O      |      108 |     0.002% |
| 719  | oscar            | Realme       | Realme 9 Pro 5G, Realme … | Snapdragon 695     | 2022-02-23   | O      |      107 |     0.002% |
| 719  | fortunave3g      | Samsung      | Galaxy Grand Prime (SM-G… | Snapdragon 410     | 2014-10-01   | U      |      107 |     0.002% |
| 721  | gracelte         | Samsung      | Note 7 (SM-N930F)         | Exynos 8890 Octa   | 2016-09-01   | U      |      106 |     0.002% |
| 721  | P024             | ASUS         | ZenPad 8.0 (Z380KL)       | Snapdragon 410     | 2015-07-01   | D      |      106 |     0.002% |
| 723  | beyond1q         | Samsung      | Galaxy S10 (SM-G973U)     | Snapdragon 855     | 2019-03-08   | U      |      105 |     0.002% |
| 724  | yunluo           | Xiaomi       | Redmi Pad                 | Helio G99          | 2022-10-05   | U      |      104 |     0.002% |
| 724  | e3q              | Samsung      | Galaxy S24 Ultra          | Snapdragon 8 Gen 3 | 2024-01-24   | U      |      104 |     0.002% |
| 724  | ares             | Xiaomi       | POCO X4 GT, Redmi Note 1… | Dimensity 8100     | 2022-05-31   | U      |      104 |     0.002% |
| 727  | lt01lte          | Samsung      | Galaxy Tab 3 (SM-T315)    | Exynos 4212 Dual   | 2013-07-01   | U      |      103 |     0.002% |
| 727  | karatep          | Lenovo       | K6 Note, K6 Plus          | Snapdragon 430     | 2016-12-01   | U      |      103 |     0.002% |
| 727  | h918             | LG           | V20 (T-Mobile)            | Snapdragon 820     | 2016-10-01   | D      |      103 |     0.002% |
| 730  | r9q              | Samsung      | Galaxy S21 FE 5G          | Snapdragon 888 5G  | 2022-01-07   | U      |      102 |     0.002% |
| 730  | m1971            | Meizu        | 16s                       | Snapdragon 855     | 2019-04-01   | U      |      102 |     0.002% |
| 730  | Onyx             | OnePlus      | X                         | Snapdragon 801     | 2015-10-29   | U      |      102 |     0.002% |
| 733  | p10bio           |              |                           |                    |              | U      |      101 |     0.002% |
| 733  | afyonltecan      | Samsung      | Galaxy Core LTE           | Snapdragon 400     | 2014-05-01   | U      |      101 |     0.002% |
| 733  | a23              | Samsung      | Galaxy A23                | Snapdragon 680 4G  | 2022-03-25   | U      |      101 |     0.002% |
| 736  | tetris           | Nothing      | CMF Phone 1               | Dimensity 7300     | 2024-07-09   | U      |      100 |     0.002% |
| 737  | xdplus           | GPD          | XD Plus                   | MediaTek MT8176    | 2018-04-01   | U      |       99 |     0.002% |
| 737  | i9152            | Samsung      | Galaxy Mega 5.8 Duos (I9… | Broadcom BCM28155  | 2013-05-01   | U      |       99 |     0.002% |
| 737  | h870             | LG           | G6 (EU Unlocked)          | Snapdragon 821     | 2017-02-01   | D      |       99 |     0.002% |
| 740  | a04e             | Samsung      | Galaxy A04e               | Helio P35          | 2022-11-07   | U      |       98 |     0.002% |
| 741  | huashan          | Sony         | Xperia SP                 | Snapdragon S4 Pro  | 2013-04-01   | D      |       95 |     0.002% |
| 741  | d1q              |              |                           |                    |              | U      |       95 |     0.002% |
| 743  | a32x             | Samsung      | Galaxy A32 5G             | Dimensity 720      | 2021-01-22   | U      |       94 |     0.002% |
| 744  | rock             |              |                           |                    |              | U      |       93 |     0.002% |
| 744  | i9105p           | Samsung      | Galaxy S II Plus (I9105)  | Broadcom BC28155   | 2013-02-01   | U      |       93 |     0.002% |
| 744  | gt58lte          | Samsung      | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |       93 |     0.002% |
| 744  | a50              | Samsung      | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |       93 |     0.002% |
| 748  | nashc            | Realme       | 8                         | Helio G95          | 2021-03-25   | U      |       92 |     0.002% |
| 748  | X6531            | Infinix      | Hot 50i                   | Helio G81          | 2024-10-01   | U      |       92 |     0.002% |
| 750  | alice            | Huawei       | P8 Lite (ALE-L21)         | Kirin 620          | 2015-05-01   | U      |       91 |     0.002% |
| 750  | a03s             | Samsung      | Galaxy A03s               | Helio P35          | 2021-08-18   | U      |       91 |     0.002% |
| 752  | odroidm1         | HardKernel   | ODROID-M1                 | Rockchip RK3568B2  | 2022-04-03   | U      |       90 |     0.002% |
| 752  | m5               | Banana Pi    | M5 (Android TV)           | Amlogic S905X3     | 2020-12-01   | O      |       90 |     0.002% |
| 752  | berlna           | Motorola     | edge 2021                 | Snapdragon 778G 5G | 2021-08-19   | O      |       90 |     0.002% |
| 752  | axolotl          | SHIFT        | SHIFT6mq                  | Snapdragon 845     | 2020-06-01   | O      |       90 |     0.002% |
| 756  | tank             |              |                           |                    |              | U      |       89 |     0.002% |
| 757  | o7prolte         | Samsung      | Galaxy On7                | Snapdragon 410     | 2015-11-01   | U      |       88 |     0.002% |
| 757  | aurora           | Sony         | Xperia XZ2 Premium        | Snapdragon 845     | 2018-04-01   | O      |       88 |     0.002% |
| 759  | waydroid_kvadra… | virtual      | Waydroid                  | ARM64              |              | U      |       87 |     0.002% |
| 759  | oxford           |              |                           |                    |              | U      |       87 |     0.002% |
| 759  | gts7xlwifi       | Samsung      | Galaxy Tab S7+ Wifi       | Snapdragon 865 5G+ | 2020-08-21   | U      |       87 |     0.002% |
| 762  | icosa_sr         |              |                           |                    |              | U      |       86 |     0.002% |
| 763  | g710ulm          | LG           | G7 ThinQ (G710ULM/VMX)    | Snapdragon 845     | 2018-05-02   | O      |       85 |     0.002% |
| 763  | dora             | Sony         | Xperia X Performance      | Snapdragon 820     | 2016-07-01   | U      |       85 |     0.002% |
| 763  | Crystal          |              |                           |                    |              | U      |       85 |     0.002% |
| 766  | X6833B           | Infinix      | Note 30 (X6833B)          | Helio G99          | 2023-05-22   | U      |       84 |     0.002% |
| 767  | waydroid_arm     |              |                           |                    |              | U      |       83 |     0.002% |
| 767  | sphynx           | Google       | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       83 |     0.002% |
| 767  | mayfly           | Xiaomi       | Xiaomi 12S                | Snapdragon 8+ Gen1 | 2022-07-01   | O      |       83 |     0.002% |
| 767  | RMX1971          |              |                           |                    |              | U      |       83 |     0.002% |
| 771  | nx551j           | Nubia        | M2                        | Snapdragon 625     | 2017-06-01   | U      |       82 |     0.002% |
| 771  | frd              | Huawei       | Honor 8                   | Kirin 950          | 2016-07-01   | U      |       82 |     0.002% |
| 771  | a20e             | Samsung      | Galaxy A20e               | Exynos 7884        | 2019-05-01   | U      |       82 |     0.002% |
| 771  | X01AD            | ASUS         | Zenfone Max M2            | Snapdragon 632     | 2018-12-01   | D      |       82 |     0.002% |
| 771  | LH7n             | TECNO        | Pova 5 (LH7n)             | Helio G99          | 2023-07-01   | U      |       82 |     0.002% |
| 776  | samurai          |              |                           |                    |              | U      |       81 |     0.002% |
| 776  | m31s             |              |                           |                    |              | U      |       81 |     0.002% |
| 776  | lime             |              |                           |                    |              | U      |       81 |     0.002% |
| 776  | j23g             | Samsung      | Galaxy J2 (SM-J200H)      | Exynos 3475 Quad   | 2015-09-01   | U      |       81 |     0.002% |
| 776  | a13x             | Samsung      | Galaxy A13 5G             | Dimensity 700 5G   | 2021-12-03   | U      |       81 |     0.002% |
| 781  | pdx201           |              |                           |                    |              | U      |       80 |     0.002% |
| 781  | m307f            |              |                           |                    |              | U      |       80 |     0.002% |
| 781  | h910             | LG           | V20 (AT&T)                | Snapdragon 820     | 2016-10-01   | D      |       80 |     0.002% |
| 781  | ether            | Nextbit      | Robin                     | Snapdragon 808     | 2016-02-01   | D      |       80 |     0.002% |
| 781  | a22x             |              |                           |                    |              | U      |       80 |     0.002% |
| 786  | wt88047x         |              |                           |                    |              | U      |       79 |     0.002% |
| 786  | pocket2          |              |                           |                    |              | U      |       79 |     0.002% |
| 786  | olivelite        |              |                           |                    |              | U      |       79 |     0.002% |
| 786  | mojito           |              |                           |                    |              | U      |       79 |     0.002% |
| 786  | a10dd            |              |                           |                    |              | U      |       79 |     0.002% |
| 791  | x55              |              |                           |                    |              | U      |       78 |     0.002% |
| 791  | scorpio          | Xiaomi       | Mi Note 2                 | Snapdragon 821     | 2016-11-01   | D      |       78 |     0.002% |
| 791  | lithium          | Xiaomi       | Mi MIX                    | Snapdragon 821     | 2016-10-01   | D      |       78 |     0.002% |
| 791  | gale             |              |                           |                    |              | U      |       78 |     0.002% |
| 795  | mars             | Xiaomi       | Mi 11 Pro                 | Snapdragon 888     | 2021-03-01   | D      |       77 |     0.002% |
| 795  | jackpotlte       | Samsung      | Galaxy A8 2018            | Exynos 7885        | 2018-01-01   | U      |       77 |     0.002% |
| 795  | jackpot2lte      |              |                           |                    |              | U      |       77 |     0.002% |
| 795  | c1s              |              |                           |                    |              | U      |       77 |     0.002% |
| 799  | axon7            | ZTE          | Axon 7                    | Snapdragon 820     | 2016-06-01   | D      |       76 |     0.002% |
| 799  | X6739            |              |                           |                    |              | U      |       76 |     0.002% |
| 801  | porg             | NVIDIA       | Jetson Nano [Android TV]… | Tegra X1 (T210)    | 2019-03-18   | O      |       75 |     0.002% |
| 801  | odessa           |              |                           |                    |              | U      |       75 |     0.002% |
| 801  | nora             |              |                           |                    |              | U      |       75 |     0.002% |
| 801  | judyp            | LG           | V35 ThinQ                 | Snapdragon 845     | 2018-05-30   | O      |       75 |     0.002% |
| 801  | j7eltexx         |              |                           |                    |              | U      |       75 |     0.002% |
| 801  | cruiserltesq     |              |                           |                    |              | U      |       75 |     0.002% |
| 801  | Pacman           |              |                           |                    |              | U      |       75 |     0.002% |
| 808  | wade             | Dynalink     | TV Box 4K (2021)          | Amlogic S905Y2     | 2021-06-01   | O      |       74 |     0.002% |
| 808  | eqs              | Motorola     | edge 30 ultra             | Snapdragon 8+ Gen1 | 2022-09-01   | O      |       74 |     0.002% |
| 808  | asteroids        |              |                           |                    |              | U      |       74 |     0.002% |
| 811  | olives           |              |                           |                    |              | U      |       73 |     0.002% |
| 811  | bitra            |              |                           |                    |              | U      |       73 |     0.002% |
| 811  | b4q              |              |                           |                    |              | U      |       73 |     0.002% |
| 811  | A6020            | Lenovo       | Vibe K5, Vibe K5 Plus     | Snapdragon 415     | 2016-04-01   | D      |       73 |     0.002% |
| 815  | wt89536          |              |                           |                    |              | U      |       72 |     0.002% |
| 815  | q4q              |              |                           |                    |              | U      |       72 |     0.002% |
| 815  | everpal          |              |                           |                    |              | U      |       72 |     0.002% |
| 815  | chuwi_vi10plus   |              |                           |                    |              | U      |       72 |     0.002% |
| 819  | nx595j           |              |                           |                    |              | U      |       71 |     0.002% |
| 819  | casuarina        | Vsmart       | Joy 3, Joy 3+             | Snapdragon 632     | 2020-02-14   | O      |       71 |     0.002% |
| 819  | a6plte           |              |                           |                    |              | U      |       71 |     0.002% |
| 822  | sweet_k6a        |              |                           |                    |              | U      |       70 |     0.002% |
| 822  | p6800            |              |                           |                    |              | U      |       70 |     0.002% |
| 822  | nobleltejv       |              |                           |                    |              | U      |       70 |     0.002% |
| 822  | kyleprods        |              |                           |                    |              | U      |       70 |     0.002% |
| 826  | perry            |              |                           |                    |              | U      |       69 |     0.002% |
| 826  | ferrari          |              |                           |                    |              | U      |       69 |     0.002% |
| 826  | citrus           |              |                           |                    |              | U      |       69 |     0.002% |
| 826  | Dragon           |              |                           |                    |              | U      |       69 |     0.002% |
| 830  | tate             |              |                           |                    |              | U      |       68 |     0.002% |
| 830  | a31              |              |                           |                    |              | U      |       68 |     0.002% |
| 832  | m51              |              |                           |                    |              | U      |       67 |     0.002% |
| 832  | aio_otfp         |              |                           |                    |              | U      |       67 |     0.002% |
| 832  | a30s             |              |                           |                    |              | U      |       67 |     0.002% |
| 835  | klteactivexx     | Samsung      | Galaxy S5 Active (G870F)  | Snapdragon 801     | 2014-12-01   | D      |       66 |     0.002% |
| 835  | h3gduoschn       |              |                           |                    |              | U      |       66 |     0.002% |
| 835  | condor           | Motorola     | moto e                    | Snapdragon 200     | 2014-05-13   | D      |       66 |     0.002% |
| 835  | caihong          |              |                           |                    |              | U      |       66 |     0.002% |
| 835  | GM9PRO_sprout    |              |                           |                    |              | U      |       66 |     0.002% |
| 840  | tilapia          |              |                           |                    |              | U      |       65 |     0.002% |
| 840  | kingdom          | Lenovo       | Vibe Z2 Pro               | Snapdragon 801     | 2014-09-01   | D      |       65 |     0.002% |
| 840  | cuscoi           |              |                           |                    |              | U      |       65 |     0.002% |
| 840  | Daredevil        |              |                           |                    |              | U      |       65 |     0.002% |
| 840  | A001D            |              |                           |                    |              | U      |       65 |     0.002% |
| 845  | zippo            | Lenovo       | Z6 Pro                    | Snapdragon 855     | 2019-09-11   | O      |       64 |     0.001% |
| 845  | ruby             |              |                           |                    |              | U      |       64 |     0.001% |
| 845  | jd2019           |              |                           |                    |              | U      |       64 |     0.001% |
| 845  | RMX2030          |              |                           |                    |              | U      |       64 |     0.001% |
| 845  | RMX1911          |              |                           |                    |              | U      |       64 |     0.001% |
| 850  | nx611j           | Nubia        | Z18 Mini                  | Snapdragon 660     | 2018-04-01   | O      |       63 |     0.001% |
| 850  | nx569j           |              |                           |                    |              | U      |       63 |     0.001% |
| 850  | j1x3gxx          |              |                           |                    |              | U      |       63 |     0.001% |
| 850  | h830             | LG           | G5 (T-Mobile)             | Snapdragon 820     | 2016-02-01   | D      |       63 |     0.001% |
| 850  | gprimeltexx      |              |                           |                    |              | U      |       63 |     0.001% |
| 850  | f300             |              |                           |                    |              | U      |       63 |     0.001% |
| 850  | benz             | OnePlus      | OnePlus Nord CE4          | Snapdragon 7 Gen 3 | 2024-04-01   | O      |       63 |     0.001% |
| 850  | Z00xD            |              |                           |                    |              | U      |       63 |     0.001% |
| 858  | r5q              |              |                           |                    |              | U      |       62 |     0.001% |
| 858  | on5ltetmo        |              |                           |                    |              | U      |       62 |     0.001% |
| 858  | liber            | Motorola     | one fusion+, one fusion+… | Snapdragon 730     | 2020-06-01   | D      |       62 |     0.001% |
| 858  | gunnar           | OnePlus      | OnePlus Nord N20          | Snapdragon 695     | 2022-04-28   | O      |       62 |     0.001% |
| 858  | cupidr           |              |                           |                    |              | U      |       62 |     0.001% |
| 858  | clark            | Motorola     | moto x pure edition (201… | Snapdragon 808     | 2015-09-01   | D      |       62 |     0.001% |
| 858  | andromeda        |              |                           |                    |              | U      |       62 |     0.001% |
| 858  | amogus_doha      |              |                           |                    |              | U      |       62 |     0.001% |
| 858  | a24              |              |                           |                    |              | U      |       62 |     0.001% |
| 867  | a6000            |              |                           |                    |              | U      |       61 |     0.001% |
| 867  | a04              |              |                           |                    |              | U      |       61 |     0.001% |
| 869  | le_x620          |              |                           |                    |              | U      |       60 |     0.001% |
| 869  | corfur           |              |                           |                    |              | U      |       60 |     0.001% |
| 871  | j1mini3gxw       |              |                           |                    |              | U      |       59 |     0.001% |
| 871  | comet            | Google       | Pixel 9 Pro Fold          | Tensor G4          | 2024-09-04   | O      |       59 |     0.001% |
| 873  | y2q              |              |                           |                    |              | U      |       58 |     0.001% |
| 873  | RMX1801          | Realme       | Realme 2 Pro              | Snapdragon 660     | 2018-10-11   | D      |       58 |     0.001% |
| 875  | starqltesq       |              |                           |                    |              | U      |       57 |     0.001% |
| 875  | nx523j           |              |                           |                    |              | U      |       57 |     0.001% |
| 875  | ghost            | Motorola     | moto x                    | Snapdragon S4 Pro  | 2013-08-23   | D      |       57 |     0.001% |
| 875  | e1s              |              |                           |                    |              | U      |       57 |     0.001% |
| 875  | PNX_sprout       |              |                           |                    |              | U      |       57 |     0.001% |
| 880  | ursa             | Xiaomi       | Mi 8 Explorer Edition     | Snapdragon 845     | 2018-07-01   | O      |       56 |     0.001% |
| 880  | olive            |              |                           |                    |              | U      |       56 |     0.001% |
| 880  | maguro           | Google       | Galaxy Nexus GSM          | OMAP 4460          | 2011-10-01   | D      |       56 |     0.001% |
| 880  | greatqlte        |              |                           |                    |              | U      |       56 |     0.001% |
| 880  | RMX2151L1        |              |                           |                    |              | U      |       56 |     0.001% |
| 885  | quark            |              |                           |                    |              | U      |       55 |     0.001% |
| 885  | lunaa            |              |                           |                    |              | U      |       55 |     0.001% |
| 885  | klimtdcm         |              |                           |                    |              | U      |       55 |     0.001% |
| 885  | jfltespr         | Samsung      | Galaxy S4 (SCH-R970, SPH… | Snapdragon 600     | 2013-04-01   | D      |       55 |     0.001% |
| 889  | picasso          |              |                           |                    |              | U      |       54 |     0.001% |
| 889  | pearl            |              |                           |                    |              | U      |       54 |     0.001% |
| 889  | k3gxx            | Samsung      | Galaxy S5 (International… | Exynos 5422        | 2014-03-01   | D      |       54 |     0.001% |
| 889  | hl3g             |              |                           |                    |              | U      |       54 |     0.001% |
| 889  | h815             | LG           | G4 (International)        | Snapdragon 808     | 2015-06-01   | D      |       54 |     0.001% |
| 894  | zorn             |              |                           |                    |              | U      |       53 |     0.001% |
| 894  | ks01lte          | Samsung      | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | D      |       53 |     0.001% |
| 894  | kmini3g          |              |                           |                    |              | U      |       53 |     0.001% |
| 894  | hllte            |              |                           |                    |              | U      |       53 |     0.001% |
| 894  | beyond2          |              |                           |                    |              | U      |       53 |     0.001% |
| 894  | 2036             |              |                           |                    |              | U      |       53 |     0.001% |
| 900  | tiare            |              |                           |                    |              | U      |       52 |     0.001% |
| 900  | pro1             | F(x)tec      | Pro¹                      | Snapdragon 835     | 2019-10-01   | O      |       52 |     0.001% |
| 900  | g0s              |              |                           |                    |              | U      |       52 |     0.001% |
| 900  | dream2qltesq     |              |                           |                    |              | U      |       52 |     0.001% |
| 900  | a25x             |              |                           |                    |              | U      |       52 |     0.001% |
| 900  | a16              |              |                           |                    |              | U      |       52 |     0.001% |
| 900  | TB8504F          |              |                           |                    |              | U      |       52 |     0.001% |
| 900  | P661N            |              |                           |                    |              | U      |       52 |     0.001% |
| 908  | pissarro         |              |                           |                    |              | U      |       51 |     0.001% |
| 908  | enzo             |              |                           |                    |              | U      |       51 |     0.001% |
| 908  | betalm           | LG           | G8s ThinQ                 | Snapdragon 855     | 2019-06-01   | O      |       51 |     0.001% |
| 911  | me173x           |              |                           |                    |              | U      |       50 |     0.001% |
| 911  | m14x             |              |                           |                    |              | U      |       50 |     0.001% |
| 911  | james            |              |                           |                    |              | U      |       50 |     0.001% |
| 911  | hennessy         |              |                           |                    |              | U      |       50 |     0.001% |
| 911  | X3               |              |                           |                    |              | U      |       50 |     0.001% |
| 916  | thea             | Motorola     | moto g LTE (2014)         | Snapdragon 400     | 2015-01-01   | D      |       49 |     0.001% |
| 916  | r1q              |              |                           |                    |              | U      |       49 |     0.001% |
| 916  | kltechn          | Samsung      | Galaxy S5 LTE (G9006V/8V) | Snapdragon 801     | 2014-04-01   | D      |       49 |     0.001% |
| 919  | zeekr            |              |                           |                    |              | U      |       47 |     0.001% |
| 920  | logan2g          |              |                           |                    |              | U      |       46 |     0.001% |
| 920  | lentislte        | Samsung      | Galaxy S5 LTE-A           | Snapdragon 805     | 2014-07-15   | D      |       46 |     0.001% |
| 920  | j7duolte         |              |                           |                    |              | U      |       46 |     0.001% |
| 920  | ef63             |              |                           |                    |              | U      |       46 |     0.001% |
| 920  | breeze           |              |                           |                    |              | U      |       46 |     0.001% |
| 920  | MT6893           |              |                           |                    |              | U      |       46 |     0.001% |
| 920  | 2027             |              |                           |                    |              | U      |       46 |     0.001% |
| 927  | a20s             |              |                           |                    |              | U      |       45 |     0.001% |
| 927  | a13ve            |              |                           |                    |              | U      |       45 |     0.001% |
| 927  | TB3710F          |              |                           |                    |              | U      |       45 |     0.001% |
| 930  | star2qltecs      |              |                           |                    |              | U      |       44 |     0.001% |
| 930  | rhannah          | Motorola     | moto e5 plus (XT1924-1/2… | Snapdragon 425     | 2018-05-01   | D      |       44 |     0.001% |
| 930  | r0q              |              |                           |                    |              | U      |       44 |     0.001% |
| 930  | mediapadm5lte    |              |                           |                    |              | U      |       44 |     0.001% |
| 930  | malachite        |              |                           |                    |              | U      |       44 |     0.001% |
| 930  | RMX3852          |              |                           |                    |              | U      |       44 |     0.001% |
| 930  | OP4F2F           |              |                           |                    |              | U      |       44 |     0.001% |
| 937  | radxa0           | Radxa        | Zero (Android TV)         | Amlogic S905Y2     | 2020-12-01   | O      |       43 |    0.0010% |
| 937  | m01q             |              |                           |                    |              | U      |       43 |    0.0010% |
| 937  | kltedcmactive    |              |                           |                    |              | U      |       43 |    0.0010% |
| 937  | eyeul            |              |                           |                    |              | U      |       43 |    0.0010% |
| 937  | a5y17ltecan      |              |                           |                    |              | U      |       43 |    0.0010% |
| 937  | TB2X30L          |              |                           |                    |              | U      |       43 |    0.0010% |
| 943  | vs995            | LG           | V20 (Verizon)             | Snapdragon 820     | 2016-10-01   | D      |       42 |    0.0010% |
| 943  | r0s              |              |                           |                    |              | U      |       42 |    0.0010% |
| 943  | psyche           |              |                           |                    |              | U      |       42 |    0.0010% |
| 943  | eagle            |              |                           |                    |              | U      |       42 |    0.0010% |
| 943  | beryl            |              |                           |                    |              | U      |       42 |    0.0010% |
| 943  | PAN_sprout       |              |                           |                    |              | U      |       42 |    0.0010% |
| 949  | halo             |              |                           |                    |              | U      |       41 |    0.0009% |
| 949  | gprimelte        |              |                           |                    |              | U      |       41 |    0.0009% |
| 949  | a10s             |              |                           |                    |              | U      |       41 |    0.0009% |
| 949  | RMX2001          |              |                           |                    |              | U      |       41 |    0.0009% |
| 949  | Amber            | Yandex       | Phone                     | Snapdragon 630     | 2018-12-01   | D      |       41 |    0.0009% |
| 954  | vns              |              |                           |                    |              | U      |       40 |    0.0009% |
| 954  | vela             | Xiaomi       | Mi CC9 Meitu Edition      | Snapdragon 710     | 2019-09-01   | O      |       40 |    0.0009% |
| 954  | us996            | LG           | V20 (GSM Unlocked)        | Snapdragon 820     | 2016-10-01   | D      |       40 |    0.0009% |
| 954  | rubens           |              |                           |                    |              | U      |       40 |    0.0009% |
| 954  | kylepro          |              |                           |                    |              | U      |       40 |    0.0009% |
| 954  | denniz           |              |                           |                    |              | U      |       40 |    0.0009% |
| 954  | Z00T             | ASUS         | Zenfone 2 Laser (1080p),… | Snapdragon 615     | 2015-11-01   | D      |       40 |    0.0009% |
| 961  | zerofltecan      |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | z3q              |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | t6               | HTC          | One Max (GSM)             | Snapdragon 600     | 2013-10-01   | D      |       39 |    0.0009% |
| 961  | sltexx           |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | m30lte           |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | loganreltexx     |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | find7            | OPPO         | Find 7a, Find 7s          | Snapdragon 801     | 2014-03-19   | D      |       39 |    0.0009% |
| 961  | corot            |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | charlotte        | Huawei       | P20 Pro                   | Kirin 970          | 2018-04-01   | D      |       39 |    0.0009% |
| 961  | a14x             |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | Z500             |              |                           |                    |              | U      |       39 |    0.0009% |
| 961  | RMX1805          |              |                           |                    |              | U      |       39 |    0.0009% |
| 973  | zizhan           | Xiaomi       | MIX Fold 2                | Snapdragon 8+ Gen1 | 2022-08-11   | O      |       38 |    0.0009% |
| 973  | zangyapro        | BQ           | Aquaris X2 Pro            | Snapdragon 626     | 2017-06-01   | D      |       38 |    0.0009% |
| 973  | x6833b           |              |                           |                    |              | U      |       38 |    0.0009% |
| 973  | taoyao           |              |                           |                    |              | U      |       38 |    0.0009% |
| 973  | mi439            |              |                           |                    |              | U      |       38 |    0.0009% |
| 973  | j2xlte           |              |                           |                    |              | U      |       38 |    0.0009% |
| 973  | fde_x86_64       |              |                           |                    |              | U      |       38 |    0.0009% |
| 973  | e8               |              |                           |                    |              | U      |       38 |    0.0009% |
| 981  | starqltecs       |              |                           |                    |              | U      |       37 |    0.0009% |
| 981  | m307fn           |              |                           |                    |              | U      |       37 |    0.0009% |
| 981  | cezanne          |              |                           |                    |              | U      |       37 |    0.0009% |
| 984  | memul            |              |                           |                    |              | U      |       36 |    0.0008% |
| 984  | androidbox       |              |                           |                    |              | U      |       36 |    0.0008% |
| 984  | Z00A             | ASUS         | Zenfone 2 (1080p)         | Atom Z3580         | 2015-03-01   | D      |       36 |    0.0008% |
| 984  | TB3-850M         |              |                           |                    |              | U      |       36 |    0.0008% |
| 988  | dreamqlteue      |              |                           |                    |              | U      |       35 |    0.0008% |
| 988  | a23xq            |              |                           |                    |              | U      |       35 |    0.0008% |
| 988  | 2026             |              |                           |                    |              | U      |       35 |    0.0008% |
| 991  | venice           |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | star2lteks       |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | smi              |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | parker           | Motorola     | one zoom                  | Snapdragon 675     | 2019-09-05   | D      |       34 |    0.0008% |
| 991  | dm2q             |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | bloomq           |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | a3core           |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | OP4863           |              |                           |                    |              | U      |       34 |    0.0008% |
| 991  | ASUS_X00AD_2     |              |                           |                    |              | U      |       34 |    0.0008% |
| 1000 | ziti             |              |                           |                    |              | U      |       33 |    0.0008% |
| 1000 | rubyx            |              |                           |                    |              | U      |       33 |    0.0008% |
| 1000 | m2note           |              |                           |                    |              | U      |       33 |    0.0008% |
| 1000 | l01k             | LG           | V30 (Japan)               | Snapdragon 835     | 2017-08-01   | O      |       33 |    0.0008% |
| 1000 | j5xnltexx        |              |                           |                    |              | U      |       33 |    0.0008% |
| 1000 | e8d              |              |                           |                    |              | U      |       33 |    0.0008% |
| 1000 | a3xeltexx        |              |                           |                    |              | U      |       33 |    0.0008% |
| 1000 | X6532            |              |                           |                    |              | U      |       33 |    0.0008% |
| 1008 | tiro             |              |                           |                    |              | U      |       32 |    0.0007% |
| 1008 | roth             | NVIDIA       | Shield Portable           | Tegra 4 (T114)     | 2013-07-31   | D      |       32 |    0.0007% |
| 1008 | ivy              | Sony         | Xperia Z3+                | Snapdragon 810     | 2015-06-01   | D      |       32 |    0.0007% |
| 1008 | hiae             | HTC          | One A9                    | Snapdragon 617     | 2015-10-20   | D      |       32 |    0.0007% |
| 1008 | greatqlteue      |              |                           |                    |              | U      |       32 |    0.0007% |
| 1008 | delos3geur       |              |                           |                    |              | U      |       32 |    0.0007% |
| 1008 | d2att            | Samsung      | Galaxy S III (AT&T)       | Snapdragon S4 Plus | 2012-06-28   | D      |       32 |    0.0007% |
| 1008 | a5dwg            |              |                           |                    |              | U      |       32 |    0.0007% |
| 1008 | Z00L             | ASUS         | Zenfone 2 Laser (720p)    | Snapdragon 410     | 2015-11-01   | D      |       32 |    0.0007% |
| 1008 | 1951             |              |                           |                    |              | U      |       32 |    0.0007% |
| 1008 | 1907             |              |                           |                    |              | U      |       32 |    0.0007% |
| 1019 | x3               |              |                           |                    |              | U      |       31 |    0.0007% |
| 1019 | star             |              |                           |                    |              | U      |       31 |    0.0007% |
| 1019 | spartan          |              |                           |                    |              | U      |       31 |    0.0007% |
| 1019 | pele             |              |                           |                    |              | U      |       31 |    0.0007% |
| 1019 | paella           | BQ           | Aquaris X5                | Snapdragon 412     | 2015-10-14   | D      |       31 |    0.0007% |
| 1019 | hero2ltektt      |              |                           |                    |              | U      |       31 |    0.0007% |
| 1019 | g2m              | LG           | G2 Mini                   | Snapdragon 400     | 2014-04-01   | D      |       31 |    0.0007% |
| 1019 | certus64         |              |                           |                    |              | U      |       31 |    0.0007% |
| 1019 | K2               |              |                           |                    |              | U      |       31 |    0.0007% |
| 1028 | wt86528          |              |                           |                    |              | U      |       30 |    0.0007% |
| 1028 | star2qlteue      |              |                           |                    |              | U      |       30 |    0.0007% |
| 1028 | nobleltezt       |              |                           |                    |              | U      |       30 |    0.0007% |
| 1028 | h872             | LG           | G6 (T-Mobile)             | Snapdragon 821     | 2017-02-01   | D      |       30 |    0.0007% |
| 1028 | gts7xl           |              |                           |                    |              | U      |       30 |    0.0007% |
| 1028 | dream2qlteue     |              |                           |                    |              | U      |       30 |    0.0007% |
| 1028 | c2q              |              |                           |                    |              | U      |       30 |    0.0007% |
| 1028 | bathena          | Motorola     | defy 2021                 | Snapdragon 662     | 2021-06-01   | O      |       30 |    0.0007% |
| 1036 | w7               | LG           | L90                       | Snapdragon 400     | 2014-02-01   | D      |       29 |    0.0007% |
| 1036 | nx606j           | Nubia        | Z18                       | Snapdragon 845     | 2018-09-01   | O      |       29 |    0.0007% |
| 1036 | m53x             |              |                           |                    |              | U      |       29 |    0.0007% |
| 1036 | hi6250           |              |                           |                    |              | U      |       29 |    0.0007% |
| 1036 | dream2qltecan    |              |                           |                    |              | U      |       29 |    0.0007% |
| 1036 | d2spr            | Samsung      | Galaxy S III (Sprint)     | Snapdragon S4 Plus | 2012-06-28   | D      |       29 |    0.0007% |
| 1042 | z2_row           |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | scale            |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | nx591j           |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | ms01lte          |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | ef59             |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | e53g             |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | dreamqltecan     |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | atom             |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | OP4EFDL1         |              |                           |                    |              | U      |       28 |    0.0006% |
| 1042 | OP4B79L1         |              |                           |                    |              | U      |       28 |    0.0006% |
| 1052 | ulova            |              |                           |                    |              | U      |       27 |    0.0006% |
| 1052 | jag3gds          | LG           | G3 S                      | Snapdragon 400     | 2014-08-01   | D      |       27 |    0.0006% |
| 1052 | arubaslim        |              |                           |                    |              | U      |       27 |    0.0006% |
| 1052 | a82xq            |              |                           |                    |              | U      |       27 |    0.0006% |
| 1052 | a5y17ltelgt      |              |                           |                    |              | U      |       27 |    0.0006% |
| 1052 | a55x             |              |                           |                    |              | U      |       27 |    0.0006% |
| 1052 | F1               |              |                           |                    |              | U      |       27 |    0.0006% |
| 1059 | winner           |              |                           |                    |              | U      |       26 |    0.0006% |
| 1059 | porsche          |              |                           |                    |              | U      |       26 |    0.0006% |
| 1059 | m33x             |              |                           |                    |              | U      |       26 |    0.0006% |
| 1059 | alphalm          |              |                           |                    |              | U      |       26 |    0.0006% |
| 1059 | a5ul             |              |                           |                    |              | U      |       26 |    0.0006% |
| 1059 | OP4BA5L1         |              |                           |                    |              | U      |       26 |    0.0006% |
| 1059 | 1920             |              |                           |                    |              | U      |       26 |    0.0006% |
| 1066 | us996d           | LG           | V20 (GSM Unlocked - Dirt… | Snapdragon 820     | 2016-10-01   | D      |       25 |    0.0006% |
| 1066 | sirisu           |              |                           |                    |              | U      |       25 |    0.0006% |
| 1066 | e1q              |              |                           |                    |              | U      |       25 |    0.0006% |
| 1069 | sydneym          |              |                           |                    |              | U      |       24 |    0.0006% |
| 1069 | nx619j           | Nubia        | Red Magic Mars            | Snapdragon 845     | 2018-12-01   | O      |       24 |    0.0006% |
| 1069 | lexus            |              |                           |                    |              | U      |       24 |    0.0006% |
| 1069 | OP46B1           |              |                           |                    |              | U      |       24 |    0.0006% |
| 1069 | KL5              |              |                           |                    |              | U      |       24 |    0.0006% |
| 1074 | tenet            |              |                           |                    |              | U      |       23 |    0.0005% |
| 1074 | j5ltechn         |              |                           |                    |              | U      |       23 |    0.0005% |
| 1074 | emerald          |              |                           |                    |              | U      |       23 |    0.0005% |
| 1074 | ef60             |              |                           |                    |              | U      |       23 |    0.0005% |
| 1074 | X00I             |              |                           |                    |              | U      |       23 |    0.0005% |
| 1079 | ziyi             |              |                           |                    |              | U      |       22 |    0.0005% |
| 1079 | kltedcm          |              |                           |                    |              | U      |       22 |    0.0005% |
| 1079 | dogo             | Sony         | Xperia ZR                 | Snapdragon S4 Pro  | 2013-06-01   | D      |       22 |    0.0005% |
| 1079 | CK8n             |              |                           |                    |              | U      |       22 |    0.0005% |
| 1083 | shamrock         |              |                           |                    |              | U      |       21 |    0.0005% |
| 1083 | penang           |              |                           |                    |              | U      |       21 |    0.0005% |
| 1083 | passion          |              |                           |                    |              | U      |       21 |    0.0005% |
| 1083 | chef             | Motorola     | one power                 | Snapdragon 636     | 2018-10-10   | D      |       21 |    0.0005% |
| 1087 | poplar_kddi      |              |                           |                    |              | U      |       20 |    0.0005% |
| 1087 | klteaio          | Samsung      | Galaxy S5 LTE (G900AZ/S9… | Snapdragon 801     | 2014-04-11   | D      |       20 |    0.0005% |
| 1087 | amber            |              |                           |                    |              | U      |       20 |    0.0005% |
| 1087 | X00H             |              |                           |                    |              | U      |       20 |    0.0005% |
| 1091 | zircon           |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | r7sf             | OPPO         | R7s (International)       | Snapdragon 615     | 2015-11-01   | D      |       19 |    0.0004% |
| 1091 | paros            |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | nobleltetmo      |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | kltechnduo       | Samsung      | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-04-01   | D      |       19 |    0.0004% |
| 1091 | jagnm            | LG           | G3 Beat                   | Snapdragon 400     | 2014-08-01   | D      |       19 |    0.0004% |
| 1091 | fortunalteub     |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | ebba             |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | c1q              |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | apollopro        |              |                           |                    |              | U      |       19 |    0.0004% |
| 1091 | KJ5              |              |                           |                    |              | U      |       19 |    0.0004% |
| 1102 | udon             |              |                           |                    |              | U      |       18 |    0.0004% |
| 1102 | plato            |              |                           |                    |              | U      |       18 |    0.0004% |
| 1102 | owens            |              |                           |                    |              | U      |       18 |    0.0004% |
| 1102 | odroidgo3        |              |                           |                    |              | U      |       18 |    0.0004% |
| 1102 | m8d              | HTC          | One (M8) Dual SIM         | Snapdragon 801     | 2014-06-01   | D      |       18 |    0.0004% |
| 1102 | juice            |              |                           |                    |              | U      |       18 |    0.0004% |
| 1102 | houji            |              |                           |                    |              | U      |       18 |    0.0004% |
| 1109 | zangya           | BQ           | Aquaris X2                | Snapdragon 636     | 2018-05-01   | D      |       17 |    0.0004% |
| 1109 | wly              |              |                           |                    |              | U      |       17 |    0.0004% |
| 1109 | tsubasa          | Sony         | Xperia V                  | Snapdragon S4      | 2012-09-01   | D      |       17 |    0.0004% |
| 1109 | j5ltekx          |              |                           |                    |              | U      |       17 |    0.0004% |
| 1109 | himaul           | HTC          | One M9 (GSM)              | Snapdragon 810     | 2015-03-01   | D      |       17 |    0.0004% |
| 1109 | cs02             |              |                           |                    |              | U      |       17 |    0.0004% |
| 1115 | vitamin          |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | ulysse           |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | serranoltespr    |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | piccolo          | BQ           | Aquaris M5                | Snapdragon 615     | 2015-08-01   | D      |       16 |    0.0004% |
| 1115 | lv517            |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | h96_max_x3       |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | h815_usu         |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | eqe              |              |                           |                    |              | U      |       16 |    0.0004% |
| 1115 | X6871            |              |                           |                    |              | U      |       16 |    0.0004% |
| 1124 | ph2n             |              |                           |                    |              | U      |       15 |    0.0003% |
| 1124 | figo             | Huawei       | P Smart                   | Kirin 659          | 2017-12-01   | D      |       15 |    0.0003% |
| 1124 | f1f              | OPPO         | F1 (International)        | Snapdragon 615     | 2016-01-01   | D      |       15 |    0.0003% |
| 1124 | ctwo             |              |                           |                    |              | U      |       15 |    0.0003% |
| 1128 | tbelteskt        |              |                           |                    |              | U      |       14 |    0.0003% |
| 1128 | rio              |              |                           |                    |              | U      |       14 |    0.0003% |
| 1128 | nx609j           | Nubia        | Red Magic                 | Snapdragon 835     | 2018-04-01   | D      |       14 |    0.0003% |
| 1128 | mint             | Sony         | Xperia T                  | Snapdragon S4      | 2012-09-01   | D      |       14 |    0.0003% |
| 1128 | hayabusa         | Sony         | Xperia TX                 | Snapdragon S4      | 2012-08-01   | D      |       14 |    0.0003% |
| 1128 | a7lte            |              |                           |                    |              | U      |       14 |    0.0003% |
| 1128 | a6010            |              |                           |                    |              | U      |       14 |    0.0003% |
| 1135 | h812_usu         |              |                           |                    |              | U      |       13 |    0.0003% |
| 1135 | P1m              |              |                           |                    |              | U      |       13 |    0.0003% |
| 1137 | z3dual           |              |                           |                    |              | U      |       12 |    0.0003% |
| 1137 | willow           |              |                           |                    |              | U      |       12 |    0.0003% |
| 1137 | r7plus           | OPPO         | R7 Plus (International)   | Snapdragon 615     | 2015-05-01   | D      |       12 |    0.0003% |
| 1137 | kltevzw          |              |                           |                    |              | U      |       12 |    0.0003% |
| 1137 | gohan            | BQ           | Aquaris X5 Plus           | Snapdragon 652     | 2016-07-01   | D      |       12 |    0.0003% |
| 1137 | a53gxx           |              |                           |                    |              | U      |       12 |    0.0003% |
| 1143 | y560             |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | s3_h560          |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | prague           |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | p7_l10           |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | jflteatt         | Samsung      | Galaxy S4 (SGH-I337)      | Snapdragon 600     | 2013-04-01   | D      |       11 |    0.0003% |
| 1143 | j7xlte           |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | j3xltebmc        |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | f400             | LG           | G3 (Korea)                | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | d852             | LG           | G3 (Canada)               | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | d851             | LG           | G3 (T-Mobile)             | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | d850             | LG           | G3 (AT&T)                 | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | crownqltechn     |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | anne             | Huawei       | P20 Lite                  | Kirin 659          | 2018-03-01   | D      |       11 |    0.0003% |
| 1143 | a70s             |              |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | TP1803           | Nubia        | Mini 5G                   | Snapdragon 855     | 2019-04-01   | O      |       11 |    0.0003% |
| 1143 | A5_Pro           |              |                           |                    |              | U      |       11 |    0.0003% |
| 1159 | w5               | LG           | Optimus L70               | Snapdragon 200     | 2014-04-01   | D      |       10 |    0.0002% |
| 1159 | vegetalte        | BQ           | Aquaris E5 4G, Aquaris E… | Snapdragon 410     | 2014-11-01   | D      |       10 |    0.0002% |
| 1159 | odroidn2l        |              |                           |                    |              | U      |       10 |    0.0002% |
| 1159 | nicki            | Sony         | Xperia M                  | Snapdragon S4 Plus | 2013-06-01   | D      |       10 |    0.0002% |
| 1159 | i9100g           |              |                           |                    |              | U      |       10 |    0.0002% |
| 1159 | htc_820g_plus    |              |                           |                    |              | U      |       10 |    0.0002% |
| 1159 | coreprimeve3g    |              |                           |                    |              | U      |       10 |    0.0002% |
| 1159 | a5ltexx          |              |                           |                    |              | U      |       10 |    0.0002% |
| 1159 | RMX3242          |              |                           |                    |              | U      |       10 |    0.0002% |
| 1168 | urd              |              |                           |                    |              | U      |        9 |    0.0002% |
| 1168 | m8qlul           |              |                           |                    |              | U      |        9 |    0.0002% |
| 1168 | ls990            | LG           | G3 (Sprint)               | Snapdragon 801     | 2014-06-01   | D      |        9 |    0.0002% |
| 1168 | h930             |              |                           |                    |              | U      |        9 |    0.0002% |
| 1168 | frescoltekor     |              |                           |                    |              | U      |        9 |    0.0002% |
| 1168 | flashlm          |              |                           |                    |              | U      |        9 |    0.0002% |
| 1168 | caymanslm        | LG           | Velvet                    | Snapdragon 845     | 2020-07-31   | O      |        9 |    0.0002% |
| 1175 | x500             |              |                           |                    |              | U      |        8 |    0.0002% |
| 1175 | vee7             |              |                           |                    |              | U      |        8 |    0.0002% |
| 1175 | onc              |              |                           |                    |              | U      |        8 |    0.0002% |
| 1175 | ef56             |              |                           |                    |              | U      |        8 |    0.0002% |
| 1175 | caza             |              |                           |                    |              | U      |        8 |    0.0002% |
| 1175 | ahannah          | Motorola     | moto e5 plus (XT1924-3/9) | Snapdragon 430     | 2018-05-01   | D      |        8 |    0.0002% |
| 1175 | Tiare_4_19       |              |                           |                    |              | U      |        8 |    0.0002% |
| 1182 | r5xQ             |              |                           |                    |              | U      |        7 |    0.0002% |
| 1182 | poplar_canada    |              |                           |                    |              | U      |        7 |    0.0002% |
| 1182 | p839v55          |              |                           |                    |              | U      |        7 |    0.0002% |
| 1182 | light            |              |                           |                    |              | U      |        7 |    0.0002% |
| 1182 | kinzie           |              |                           |                    |              | U      |        7 |    0.0002% |
| 1182 | h811             | LG           | G4 (T-Mobile)             | Snapdragon 808     | 2015-06-01   | D      |        7 |    0.0002% |
| 1182 | GM8_sprout       |              |                           |                    |              | U      |        7 |    0.0002% |
| 1189 | wilcoxltexx      |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | trltexx          |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | sltecan          |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | osaka            |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | maverick         |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | kltespr          |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | ef71             |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | draconis         |              |                           |                    |              | U      |        6 |    0.0001% |
| 1189 | A7010a48         |              |                           |                    |              | U      |        6 |    0.0001% |
| 1198 | x1               |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | vidofnir         |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | unified7870      |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | rs988            | LG           | G5 (US Unlocked)          | Snapdragon 820     | 2016-02-01   | D      |        5 |    0.0001% |
| 1198 | nx589j           |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | j5ltexx          |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | j3xprolte        |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | iris             |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | h96pro           |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | d838             |              |                           |                    |              | U      |        5 |    0.0001% |
| 1198 | agate            |              |                           |                    |              | U      |        5 |    0.0001% |
| 1209 | v1               |              |                           |                    |              | U      |        4 |   0.00009% |
| 1209 | serranolteusc    |              |                           |                    |              | U      |        4 |   0.00009% |
| 1209 | j7ltechn         |              |                           |                    |              | U      |        4 |   0.00009% |
| 1209 | j3ltekx          |              |                           |                    |              | U      |        4 |   0.00009% |
| 1209 | idol4            |              |                           |                    |              | U      |        4 |   0.00009% |
| 1209 | NX679J           |              |                           |                    |              | U      |        4 |   0.00009% |
| 1215 | x1slte           |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | trelte           |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | sydney           |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | sf340n           |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | nemo             |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | logan            |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | fortuna3gdtv     |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | cusco            |              |                           |                    |              | U      |        3 |   0.00007% |
| 1215 | GS290            |              |                           |                    |              | U      |        3 |   0.00007% |
| 1224 | trltevzw         |              |                           |                    |              | U      |        2 |   0.00005% |
| 1224 | r5               | OPPO         | R5 (International), R5s … | Snapdragon 615     | 2014-12-01   | D      |        2 |   0.00005% |
| 1224 | h810_usu         |              |                           |                    |              | U      |        2 |   0.00005% |
| 1224 | Z00RD            |              |                           |                    |              | U      |        2 |   0.00005% |
| 1224 | X5_Max_Pro       |              |                           |                    |              | U      |        2 |   0.00005% |
| 1224 | Samsung Galaxy … |              |                           |                    |              | U      |        2 |   0.00005% |
| 1230 | shamu_t          |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | pdx223           |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | k11ta_a          |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | j7toplteskt      |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | find7s           |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | e5lte            |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | d2refreshspr     |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | a71n             |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | RMX3461          |              |                           |                    |              | U      |        1 |   0.00002% |
| 1230 | Nightmare        |              |                           |                    |              | U      |        1 |   0.00002% |
|      | Unlisted         |              |                           |                    |              |        |     5016 |      0.12% |
|      | Total            |              |                           |                    |              |        |  4330004 |    100.00% |
-------------------------------------------------------------------------------------------------------------------------------------------

Status codes: O=active official build, D=discontinued official build, U=unofficial build

Manufacturers of devices that run LineageOS
-------------------------------------------------------------------
| Rank |    Maker     | Builds | % Builds | Installs | % Installs |
-------------------------------------------------------------------
| 1    | Samsung      |    261 |    21.1% |  1208793 |     27.92% |
| 2    | Motorola     |     74 |     6.0% |  1149802 |     26.55% |
| 3    | Xiaomi       |    153 |    12.3% |   744109 |     17.18% |
| 4    | OPPO         |     16 |     1.3% |   386346 |      8.92% |
| 5    | Huawei       |     17 |     1.4% |   264093 |      6.10% |
| 6    | virtual      |     11 |     0.9% |   174380 |      4.03% |
| 7    | LG           |     40 |     3.2% |    68310 |      1.58% |
| 8    | Realme       |     14 |     1.1% |    65334 |      1.51% |
| 9    | OnePlus      |     35 |     2.8% |    56793 |      1.31% |
| 10   | Google       |     43 |     3.5% |    49406 |      1.14% |
| 11   | Amazon       |     10 |     0.8% |    43738 |      1.01% |
| 12   | Nintendo     |      2 |     0.2% |    23173 |      0.54% |
| 13   | unknown      |    389 |    31.4% |    18257 |      0.42% |
| 14   | Sony         |     53 |     4.3% |    15098 |      0.35% |
| 15   | Raspberry Pi |      3 |     0.2% |    13902 |      0.32% |
| 16   | Lenovo       |     22 |     1.8% |    12377 |      0.29% |
| 17   | LeEco        |      3 |     0.2% |     3971 |      0.09% |
| 18   | ASUS         |     12 |     1.0% |     3646 |      0.08% |
| 19   | Fairphone    |      5 |     0.4% |     3260 |      0.08% |
| 20   | Nubia        |      8 |     0.6% |     3162 |      0.07% |
| 21   | ZTE          |      3 |     0.2% |     2303 |      0.05% |
| 22   | HTC          |     10 |     0.8% |     2048 |      0.05% |
| 23   | Nokia        |      4 |     0.3% |     1540 |      0.04% |
| 24   | R36S         |      1 |    0.08% |     1194 |      0.03% |
| 25   | NVIDIA       |      6 |     0.5% |     1140 |      0.03% |
| 26   | Nothing      |      3 |     0.2% |     1129 |      0.03% |
| 27   | Essential    |      1 |    0.08% |     1025 |      0.02% |
| 28   | HardKernel   |      4 |     0.3% |     1023 |      0.02% |
| 29   | Meizu        |      2 |     0.2% |      800 |      0.02% |
| 30   | BQ           |      8 |     0.6% |      694 |      0.02% |
| 31   | GREE         |      1 |    0.08% |      621 |      0.01% |
| 32   | Razer        |      2 |     0.2% |      613 |      0.01% |
| 33   | ZUK          |      2 |     0.2% |      486 |      0.01% |
| 34   | Wingtech     |      1 |    0.08% |      365 |     0.008% |
| 35   | Wileyfox     |      2 |     0.2% |      291 |     0.007% |
| 36   | Micromax     |      1 |    0.08% |      212 |     0.005% |
| 37   | F(x)tec      |      2 |     0.2% |      205 |     0.005% |
| 38   | Infinix      |      2 |     0.2% |      176 |     0.004% |
| 39   | Sharp        |      1 |    0.08% |      150 |     0.003% |
| 40   | Walmart      |      1 |    0.08% |      129 |     0.003% |
| 41   | C Idea       |      1 |    0.08% |      115 |     0.003% |
| 42   | Solana       |      1 |    0.08% |      109 |     0.003% |
| 43   | GPD          |      1 |    0.08% |       99 |     0.002% |
| 44   | Banana Pi    |      1 |    0.08% |       90 |     0.002% |
| 45   | TECNO        |      1 |    0.08% |       82 |     0.002% |
| 46   | Nextbit      |      1 |    0.08% |       80 |     0.002% |
| 47   | Dynalink     |      1 |    0.08% |       74 |     0.002% |
| 48   | Vsmart       |      1 |    0.08% |       71 |     0.002% |
| 49   | Radxa        |      1 |    0.08% |       43 |    0.0010% |
| 50   | Yandex       |      1 |    0.08% |       41 |    0.0009% |
|      | Unlisted     |      ? |        ? |     5016 |      0.12% |
|      | Total        |   1239 |   100.0% |  4330004 |    100.00% |
-------------------------------------------------------------------

Processors of devices that run LineageOS
---------------------------------------------------------------------
| Rank | Processor Type | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Snapdragon 6   |    153 |    12.3% |  1027540 |     23.73% |
| 2    | Exynos         |    118 |     9.5% |  1010764 |     23.34% |
| 3    | Snapdragon 8   |    246 |    19.9% |   611590 |     14.12% |
| 4    | Snapdragon 4   |    103 |     8.3% |   506075 |     11.69% |
| 5    | Snapdragon 7   |     50 |     4.0% |   345671 |      7.98% |
| 6    | Kirin          |     13 |     1.0% |   199943 |      4.62% |
| 7    | X86            |      5 |     0.4% |   154396 |      3.57% |
| 8    | Helio          |     36 |     2.9% |   150751 |      3.48% |
| 9    | Omap           |      4 |     0.3% |    73743 |      1.70% |
| 10   | Dimensity      |     12 |     1.0% |    65640 |      1.52% |
| 11   | Mediatek       |     15 |     1.2% |    46088 |      1.06% |
| 12   | Tegra          |     12 |     1.0% |    29199 |      0.67% |
| 13   | unknown        |    388 |    31.3% |    18280 |      0.42% |
| 14   | Arm            |      1 |    0.08% |    16895 |      0.39% |
| 15   | Broadcom       |      7 |     0.6% |    15206 |      0.35% |
| 16   | Spreadtrum     |      9 |     0.7% |    14383 |      0.33% |
| 17   | Atom           |      5 |     0.4% |    11207 |      0.26% |
| 18   | Tensor         |     15 |     1.2% |     9166 |      0.21% |
| 19   | Snapdragon S   |     19 |     1.5% |     7914 |      0.18% |
| 20   | X86_64         |      4 |     0.3% |     2496 |      0.06% |
| 21   | Qualcomm       |      4 |     0.3% |     1726 |      0.04% |
| 22   | Snapdragon?    |      1 |    0.08% |     1335 |      0.03% |
| 23   | Rockchip       |      2 |     0.2% |     1284 |      0.03% |
| 24   | Amlogic        |      6 |     0.5% |     1087 |      0.03% |
| 25   | Snapdragon 2   |      4 |     0.3% |      872 |      0.02% |
| 26   | Arm64          |      3 |     0.2% |      683 |      0.02% |
| 27   | Novathor       |      1 |    0.08% |      634 |      0.01% |
| 28   | Marvell        |      1 |    0.08% |      222 |     0.005% |
| 29   | Snapdragon     |      1 |    0.08% |      115 |     0.003% |
| 30   | Nvidia         |      1 |    0.08% |       83 |     0.002% |
|      | Unlisted       |      ? |        ? |     5016 |      0.12% |
|      | Total          |   1239 |   100.0% |  4330004 |    100.00% |
---------------------------------------------------------------------

Status of LineageOS builds
--------------------------------------------------------
|  Status  | Builds | % Builds | Installs | % Installs |
--------------------------------------------------------
| O        |    243 |    19.6% |  2036669 |     47.04% |
| D        |    242 |    19.5% |   452225 |     10.44% |
| U        |    754 |    60.9% |  1836094 |     42.40% |
| Unlisted |      ? |        ? |     5016 |      0.12% |
| Total    |   1239 |   100.0% |  4330004 |    100.00% |
--------------------------------------------------------

LineageOS versions in active installs
---------------------------------------------------------------
| Rank | Version  | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------
| 1    | 18.1     |    582 |      47% |  1078126 |     24.90% |
| 2    | 21.0     |    529 |      43% |   993149 |     22.94% |
| 3    | 17.1     |    489 |      39% |   838631 |     19.37% |
| 4    | 20.0     |    521 |      42% |   473224 |     10.93% |
| 5    | 19.1     |    409 |      33% |   420515 |      9.71% |
| 6    | 22.2     |    430 |      35% |   160071 |      3.70% |
| 7    | 14.1     |    383 |      31% |   111443 |      2.57% |
| 8    | 15.1     |    283 |      23% |    93252 |      2.15% |
| 9    | 16.0     |    536 |      43% |    63477 |      1.47% |
| 10   | 23.0     |    266 |      21% |    29423 |      0.68% |
| 11   | 17.0     |     88 |       7% |    23160 |      0.53% |
| 12   | 22.1     |    332 |      27% |    14361 |      0.33% |
| 13   | 18.0     |     92 |       7% |     9983 |      0.23% |
| 14   | 13.0     |    140 |      11% |     8551 |      0.20% |
| 15   | 12.1     |      7 |     0.6% |     1951 |      0.05% |
| 16   | 20.3     |      1 |    0.08% |     1810 |      0.04% |
| 17   | 19.0     |    115 |       9% |     1765 |      0.04% |
| 18   | 22.0     |    115 |       9% |     1750 |      0.04% |
| 19   | 10.0     |     26 |       2% |      200 |     0.005% |
| 20   | 16.1     |      2 |     0.2% |       73 |     0.002% |
| 21   | 15.0     |      3 |     0.2% |       20 |    0.0005% |
| 22   | 20.2     |      2 |     0.2% |       19 |    0.0004% |
| 23   | 15.2     |      1 |    0.08% |       10 |    0.0002% |
| 24   | 24.0     |      1 |    0.08% |        9 |    0.0002% |
| 25   | 14.0     |      3 |     0.2% |        4 |   0.00009% |
| 26   | 25.0     |      1 |    0.08% |        3 |   0.00007% |
| 27   | 17.9     |      1 |    0.08% |        2 |   0.00005% |
| 28   | 21.3     |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted |      ? |        ? |     5016 |      0.12% |
|      | Total    |   1239 |     100% |  4330004 |    100.00% |
---------------------------------------------------------------

Years when devices running LineageOS were released
-------------------------------------------------------------------
|   Year   |  Status  | Builds | % Builds | Installs | % Installs |
-------------------------------------------------------------------
| 2011     | O        |      0 |       0% |        0 |         0% |
| 2011     | D        |      2 |     0.2% |      604 |      0.01% |
| 2011     | U        |      1 |    0.08% |      159 |     0.004% |
| 2011     | Total    |      3 |     0.2% |      763 |      0.02% |
| 2012     | O        |      0 |       0% |        0 |         0% |
| 2012     | D        |     12 |     1.0% |    14012 |      0.32% |
| 2012     | U        |     10 |     0.8% |    87473 |      2.02% |
| 2012     | Total    |     22 |     1.8% |   101485 |      2.34% |
| 2013     | O        |      0 |       0% |        0 |         0% |
| 2013     | D        |     39 |     3.1% |    32951 |      0.76% |
| 2013     | U        |     19 |     1.5% |    16600 |      0.38% |
| 2013     | Total    |     58 |     4.7% |    49551 |      1.14% |
| 2014     | O        |      0 |       0% |        0 |         0% |
| 2014     | D        |     53 |     4.3% |    27641 |      0.64% |
| 2014     | U        |     39 |     3.1% |    43010 |      0.99% |
| 2014     | Total    |     92 |     7.4% |    70651 |      1.63% |
| 2015     | O        |      2 |     0.2% |      573 |      0.01% |
| 2015     | D        |     45 |     3.6% |    54825 |      1.27% |
| 2015     | U        |     38 |     3.1% |    30914 |      0.71% |
| 2015     | Total    |     85 |     6.9% |    86312 |      1.99% |
| 2016     | O        |      6 |     0.5% |    17942 |      0.41% |
| 2016     | D        |     43 |     3.5% |   232498 |      5.37% |
| 2016     | U        |     40 |     3.2% |   171145 |      3.95% |
| 2016     | Total    |     89 |     7.2% |   421585 |      9.74% |
| 2017     | O        |     17 |     1.4% |   144425 |      3.34% |
| 2017     | D        |     15 |     1.2% |    31493 |      0.73% |
| 2017     | U        |     43 |     3.5% |   356542 |      8.23% |
| 2017     | Total    |     75 |     6.1% |   532460 |     12.30% |
| 2018     | O        |     32 |     2.6% |   360337 |      8.32% |
| 2018     | D        |     23 |     1.9% |    33624 |      0.78% |
| 2018     | U        |     32 |     2.6% |   449851 |     10.39% |
| 2018     | Total    |     87 |     7.0% |   843812 |     19.49% |
| 2019     | O        |     47 |     3.8% |  1275793 |     29.46% |
| 2019     | D        |      4 |     0.3% |    18145 |      0.42% |
| 2019     | U        |     33 |     2.7% |   385260 |      8.90% |
| 2019     | Total    |     84 |     6.8% |  1679198 |     38.78% |
| 2020     | O        |     38 |     3.1% |   166910 |      3.85% |
| 2020     | D        |      5 |     0.4% |     6355 |      0.15% |
| 2020     | U        |     30 |     2.4% |    80277 |      1.85% |
| 2020     | Total    |     73 |     5.9% |   253542 |      5.86% |
| 2021     | O        |     41 |     3.3% |    44540 |      1.03% |
| 2021     | D        |      1 |    0.08% |       77 |     0.002% |
| 2021     | U        |     22 |     1.8% |   170378 |      3.93% |
| 2021     | Total    |     64 |     5.2% |   214995 |      4.97% |
| 2022     | O        |     28 |     2.3% |    11291 |      0.26% |
| 2022     | D        |      0 |       0% |        0 |         0% |
| 2022     | U        |     19 |     1.5% |     5788 |      0.13% |
| 2022     | Total    |     47 |     3.8% |    17079 |      0.39% |
| 2023     | O        |     22 |     1.8% |    11884 |      0.27% |
| 2023     | D        |      0 |       0% |        0 |         0% |
| 2023     | U        |     19 |     1.5% |     8771 |      0.20% |
| 2023     | Total    |     41 |     3.3% |    20655 |      0.48% |
| 2024     | O        |      9 |     0.7% |     2825 |      0.07% |
| 2024     | D        |      0 |       0% |        0 |         0% |
| 2024     | U        |      5 |     0.4% |     1390 |      0.03% |
| 2024     | Total    |     14 |     1.1% |     4215 |      0.10% |
| 2025     | O        |      1 |    0.08% |      149 |     0.003% |
| 2025     | D        |      0 |       0% |        0 |         0% |
| 2025     | U        |      6 |     0.5% |     1989 |      0.05% |
| 2025     | Total    |      7 |     0.6% |     2138 |      0.05% |
| unknown  | U        |    398 |    32.1% |    26547 |      0.61% |
| unknown  | Total    |    398 |    32.1% |    26547 |      0.61% |
| Unlisted | Unlisted |      ? |        ? |     5016 |      0.12% |
| Total    | Total    |   1239 |     100% |  4330004 |       100% |
-------------------------------------------------------------------

Reported on Wed. 05 Nov 2025 01:29:19 -04.
Script execution time = 17 minutes 56 seconds

```
