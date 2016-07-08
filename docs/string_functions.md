# String functions
##Modification functions
```php
string jks_string_repl(string search, string replace, string string);
```
Replace the search string in a string.

```php
string jks_string_i_repl(string search, string replace, string string);
```
Replace the search string in a string (case-insensitve) .

```php
int jks_string_find(string search, string string);
```
Search for a specific string and return the position.

```php
int jks_string_i_find(string search, string string);
```
Search for a specific string and return the position (case-insensitive).

```php
string jks_string_repe(string string, int repeat);
```
Repeats a string for x times.

```php
string jks_string_shuf(string string);
```
Shuffles a string

```php
string jks_string_sub(int start, int end, string string);
```
Cut a string from the start position to the end position.

```php
string jks_string_slashes_add(string string);
```
Add slashes to the string, to display chars like that " or '

```php
string jks_string_slashes_remove(string string);
```
Remove slashes to the string, to display chars like that " or '

```php
string jks_string_slashes_addc(string string);
```
Add slashes to the string, to display chars like that " or '

```php
string jks_string_slashes_strip(string string);
```
Strips slashes to the string, to display chars like that " or '

```php
string jks_string_slashes_stripc(string string);
```
Strips slashes to the string, to display chars like that " or '

```php
string jks_string_impl(array array);
```
Combine the array values to one string.

```php
string jks_string_expl(string split, string string);
```
Seperate the string with the split arrgument in to array values.

##Convert functions
```php
string jks_string_html_c(string string);
```
Encode a string in the htmlspecialchars format.

```php
string jks_string_html_cd(string string);
```
Decode a string in the htmlspecialchars format.

```php
string jks_string_html_e(string string);
```
Encode a string in the htmlentities format.

```php
string jks_string_html_ed(string string);
```
Decode a string in the htmlentities format.

```php
string jks_string_base64_d(string string);
```
Decode a string in the BASE64 format.

```php
string jks_string_base64_e(string string);
```
Encode a string in the BASE64 format.

```php
string jks_string_soundex_c(string string);
```
Convert the string in soundex algorithm.

```php
string jks_string_metaphone_c(string string);
```
Convert the string in to the metaphone algorithm

##Upper- and lowercase
```php
string jks_string_up(string string);
```
Returns a string, where all characters are big.

```php
string jks_string_down(string string);
```
Returns a string, where all characters are small.

```php
string jks_string_word_u(string string);
```
Returns a string, where all word beginnig chars are big.

```php
string jks_string_first_u(string string);
```
Returns a string, where only the first character are big.

##Correction functions

```php
string jks_string_tr(string string);
```
Trims a string, to remove the left and right end whitespaces.

```php
string jks_string_wowr(string string, int length, string break);
```
Wordwraps a string after a length with a break.

```php
string jks_string_2br(string string);
```
Convert the linebreaks into a &lt;br&gt; HTML Tag.

```php
string jks_string_format_number(long number, int decimals, string decimalpoint, string seperator);
```
Converts a number to a better readable number which contains decimal points and sepeators.

##Hashing

```php
string jks_string_hashing([string algo='sha256'], string string);
```
Hash the string in to a hash.

```php
string jks_string_md5_hashing(string string);
```
Hash the string in to a MD5 hash.

```php
string jks_string_sha1_hashing(string string);
```
Hash the string in to a SHA1 hash.

##String stats

```php
string jks_string_char_cnt(string string);
```
Returns the length of a string.

```php
string jks_string_word_cnt(string string);
```
Returns the number of words in a string.
