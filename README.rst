..  image:: https://img.shields.io/badge/PHP-8.4-blue.svg
    :alt: PHP 8.4
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-14-orange.svg
    :alt: TYPO3 14
    :target: https://get.typo3.org/version/14

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

=======
CHF Map
=======

This TYPO3 extension implements a data model for map tiles and features as well
as simple coordinates and geographical token distributions, as part of the
Cultural Heritage Framework (CHF). Geographical features are stored (and
serialised) as `GeoJSON <https://datatracker.ietf.org/doc/html/rfc7946>`__.
The extension also acts as a wrapper for `MapLibre GL JS <https://maplibre.org/maplibre-gl-js/docs>`__
and provides a plugin to show individual features or groups of features as
content elements in the frontend. Integrators may further specify the map tiles
they want to display as a base map.

:Repository:  https://github.com/digicademy-chf/chf_map
:Read online: https://digicademy-chf.github.io/chf_map
:TER:         https://extensions.typo3.org/extension/chf_map

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

- Frontend plugin and templates
- Import of *Namenforschung* data
- Embedded metadata
- First set of serialisations
- Search configuration
- Add API documentation

**Beyond 2.0.0**

- Add testing
- Generic import
- Additional serialisations
