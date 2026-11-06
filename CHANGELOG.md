# Changelog

## 1.1.0 — 2026-11-06

Stored data and the front-end API are unchanged: `getSettings()`, `getSettingsArray()`
and `changeSetting()` take the same arguments, and values are still stored as
`$modules->getConfig('SettingsFactory')[page-name][field-name]`.

### Fixed

- **Values that came back different from what was saved.**
  - A saved `0` (Integer, Toggle) showed as blank in the form, so the next save stored `''`.
  - Unchecking a checkbox whose definition sets `checked` did not stick. No known site
    uses `checked`.
  - Page fields (InputfieldPage) were stored as `[]`, and a stored list of IDs was not
    shown as selected. No known site uses InputfieldPage; AsmSelect with `options` was
    always fine.
- **A broken definition file could wipe saved values.** A missing file, invalid JSON, or
  a PHP file with stray output still showed a Save button, and saving stored an empty set
  for that screen. This was found by reading the code and was not reproduced on 1.0.7. The
  screen now explains what is wrong and has no Save button.
- **PHP warnings.** These came from multi-language values that were never saved,
  unsaved keys, and non-array definition results.
- **InputfieldMarkup** with a `value` is no longer blanked or stored as a setting.
- **Install** failed when the `sp_filepath` field already existed.
- **Permission check** failed when called without a page.

### Changed

- **Defaults pre-fill the admin form.** A field that has never been saved shows its
  definition default (`value`, or `checked` for a checkbox) in the form, instead of
  blank. `getSettings()` is unchanged: it returns the saved values for any user,
  without looking up pages or loading definition files.
- **Less work per request.** The module is no longer autoload, and it is a singleton.
  Before, every request ran a find for the settings pages. For a logged-in admin, it also
  ran every definition file, once per `$modules->get('SettingsFactory')` call. For
  guests, the find returns no admin pages, so no definition files ran.
- **Namespaced.** Both modules are in the `ProcessWire` namespace. `requires`
  ProcessWire 3.0.123 and PHP 7.1.

### Added

- **New methods:**
  - `getSetting($key, $name, $default)`
  - `saveSettings($key, $values)`
  - `deleteSettings($key)`
  - `getSettingsKeys()`, `getSettingsPage($key)`
  - `getDefaults($key)`, `getDefinitionError($key)`
  - `getOrphanKeys()`
- **`changeSetting()`** returns `true`/`false`. As before, it only changes fields that are already saved.
- **Module config screen.** It lists every settings page, its definition file, field
  and value counts, load errors, and stored keys left without a settings page.
- **Uninstall backup.** Uninstall writes a JSON backup of all stored settings to
  `/site/assets/backups/SettingsFactory/` before ProcessWire deletes them.
- **Clearer errors.** Definition-file errors give the reason (JSON syntax error,
  stray output, file not found) and are logged to `settings-factory` when they occur
  on the front end.
- **API call in the footer.** The superuser footer shows the API call for the screen.
- **New sample** `samples/modern-fields.php` (Toggle, TinyMCE, Datetime, Page,
  TextTags, showIf, languages). The PHP samples now declare the `ProcessWire` namespace.

## 1.0.7 — 2021-07-02

Last release before this changelog.
