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
