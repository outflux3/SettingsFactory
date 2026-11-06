Settings Factory for ProcessWire CMS
====================================

### Create unlimited settings pages!

* Ever wanted to build some functionality for a site, but need some user editable settings, and don't want to add new fields, and don't want to build a module? Maybe you are building a service that pulls data from an external site and need a place to store a URL or preferences.
* Need a place to enter data for site schema (schema.org), with the settings panels right in the admin menu?
* Need to reuse the same settings panels on various sites without creating fields?

Settings Factory is your answer. A settings screen is an admin page plus a definition file. No fields, templates or pages are created for it. The values are stored in the Settings Factory module config.

Requires ProcessWire 3.0.123+ and PHP 7.1+.

## Instructions

1. Create a page under Admin (at the top level, or under Setup if you prefer), e.g. "Weather Widget".
2. Save the page, then choose **ProcessSettingsFactory** as its process.
3. Enter the path to your settings definition file in **Inputfields Definition File Path**. The path is relative to the templates folder, e.g. `settings/weather-widget.json` (no leading slash). To get started, use one of the samples in the module's `samples/` folder, e.g. `../modules/SettingsFactory/samples/modern-fields.php`.

The settings are accessed by the *page name* of the admin page, so give it a name that makes sense in the API. Renaming the page later disconnects it from its saved values (see *Housekeeping*).

**Modules > Settings Factory** lists every settings page, its definition file, and whether the file loads.

### Access

Users need the `settings-factory` permission to open settings pages. To restrict one screen, create a permission with the same name as its admin page (e.g. `theme-settings`): users then need that permission instead.

## Definition files

Definition files are JSON or PHP files that define inputfields with the same array syntax you use for module config. Any core or site Inputfield can be used, except file and image fields, which need a page to store files on.

**JSON** — an array of inputfield definitions:

```json
[
  { "name": "api_url", "type": "InputfieldURL", "label": "API URL", "value": "" },
  { "name": "per_page", "type": "InputfieldInteger", "label": "Per page", "value": 12, "columnWidth": 50 },
  { "name": "theme", "type": "InputfieldSelect", "label": "Theme",
    "options": { "light": "Light", "dark": "Dark" }, "value": "light", "columnWidth": 50 }
]
```

**PHP** — a file that *returns* an array like the one above, an Inputfield, or an `InputfieldWrapper`. Return a wrapper to use fieldsets or tabs (`WireTab` wrappers, see `samples/wiretabs-example.php`). Options can be built at runtime, e.g. from `$pages` or `$users`.

* Start PHP files with `<?php namespace ProcessWire;` and output nothing: any text or whitespace outside the PHP tags is an error.
* Definition files are only loaded by the admin screen. `getSettings()` never loads them.
* PHP definition files must be inside `/site/templates/` or `/site/modules/`.

**Defaults.** A field's `value` is its default: it pre-fills the form until the screen is saved for the first time. `getSettings()` returns only saved values, so save each screen once after creating it or adding fields. For a checkbox, `value` is what it submits when checked, so use `"checked": true` for a default of on.

**Widths.** Use `columnWidth`. The `width` key in older samples does nothing.

**Languages.** Add `"useLanguages": true` to a text or textarea field to get one value per language when LanguageSupport is installed.

### What gets stored

| Inputfield | Stored as |
|---|---|
| Text, Textarea, TinyMCE/CKEditor, URL, Email, Select, Radios, TextTags | string |
| Integer, Toggle | integer (Toggle: `1`, `0`, or `''`) |
| Checkbox | `1` when checked, `''` when not |
| Checkboxes, AsmSelect, SelectMultiple | array of option values |
| Datetime | Unix timestamp |
| PageListSelect | page ID |
| Page (any of its inputfields) | array of page IDs |

## How to use on the front end

1. Make sure your settings screen works in the admin, fill it in and save.
2. Get the settings by the admin page's name:

```php
$factory = $modules->get('SettingsFactory');
$weather = $factory->getSettings('weather-widget');   // WireData

echo $weather->api_url;
foreach($weather as $name => $value) { /* … */ }
```

As a plain array:

```php
$weather = $factory->getSettingsArray('weather-widget');
```

One value, with a fallback:

```php
$perPage = $factory->getSetting('weather-widget', 'per_page', 10);
```

These work for any visitor, guests included. They read the saved values only, and return `null` when nothing is saved under the name (for example, a screen that was never saved). Guard with `if($settings)` where that can happen.

In a non-default language, a field's language value is returned when it is not empty; otherwise the default-language value is.

### Changing values from code

```php
$factory->changeSetting('weather-widget', 'api_url', 'https://example.com/v2');  // one value
$factory->saveSettings('weather-widget', ['api_url' => '…', 'per_page' => 20]);  // several, merged
```

`changeSetting()` only changes a field that is already saved, and returns `true` when it saved. `saveSettings()` can add new values.

### Other API

| Method | Returns |
|---|---|
| `getSettingsKeys()` | names of all settings pages |
| `getSettingsPage($key)` | the admin page for a key |
| `getDefaults($key)` | the definition defaults, field name => value (loads the definition file; for admin-side code) |
| `getDefinitionError($key)` | why a definition file failed to load (also logged to `settings-factory`) |
| `getOrphanKeys()` | stored keys with no settings page |
| `deleteSettings($key)` | removes everything stored for a key |

## Housekeeping

Values are stored in the module config as `[page-name => [field => value]]`. They stay when a settings page is deleted, trashed or renamed, and they travel with a copied database. **Modules > Settings Factory** lists such leftover keys. `getSettings()` still returns their values. Remove one with `$modules->get('SettingsFactory')->deleteSettings('key')`.

Uninstalling the module deletes its config, which is every stored value. Uninstall first writes a backup to `/site/assets/backups/SettingsFactory/settings-<date>.json`, which can be restored with:

```php
$modules->saveConfig('SettingsFactory', json_decode(file_get_contents($file), true));
```

## Upgrading from 1.0.x

Stored values, the API and what `getSettings()` returns are unchanged. See `CHANGELOG.md` for the fixes and additions.

## Support

https://processwire.com/talk/topic/17536-settings-factory/

## License

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.

(See included LICENSE file for full license text.)
