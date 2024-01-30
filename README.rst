..  image:: https://img.shields.io/badge/PHP-8.2/8.3-blue.svg
    :alt: PHP 8.2/8.3
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-13-orange.svg
    :alt: TYPO3 13
    :target: https://get.typo3.org/version/13

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

=======
CHF Map
=======

This TYPO3 extension implements a data model inpspired by `GeoJSON
<https://datatracker.ietf.org/doc/html/rfc7946>`__, as part of the Cultural
Heritage Framework (CHF). All geographical features can be serialised as valid
GeoJSON. The extension also acts as a wrapper for `Leaflet
<https://leafletjs.com>`__ and provides a plugin to show individual features
or groups of features as content elements in the frontend. Integrators may
further specify the map tiles or the image files they want to display as a
base map, which also makes this extension suitable for image maps.

:Repository:  https://github.com/digicademy-chf/chf_map
:Read online: https://digicademy-chf.github.io/chf_map
:TER:         https://extensions.typo3.org/extension/chf_map

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

- TCA and model work as expected
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
