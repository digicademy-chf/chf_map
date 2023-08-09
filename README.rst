..  image:: https://img.shields.io/badge/PHP-8.1/8.2-blue.svg
    :alt: PHP 8.1/8.2
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-12-orange.svg
    :alt: TYPO3 12
    :target: https://get.typo3.org/version/12

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

======
DA Map
======

This TYPO3 extension implements a data model inpspired by `GeoJSON
<https://datatracker.ietf.org/doc/html/rfc7946>`__. All geographical features
can be serialised as valid GeoJSON. The extension also acts as a wrapper for
`Leaflet <https://leafletjs.com>`__` and provides a plugin to show individual
our groups of features as content elements in the frontend. Integrators may
specify the map tiles or the image file to display using Leaflet.

:Repository:  https://github.com/digicademy/da-map
:Read online: https://docs.typo3.org/p/da-map/main/en-us
:TER:         https://extensions.typo3.org/extension/da-map

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

**Version 0.7.0**

- TCA and model work as expected
- Working frontend plugin

**Version 0.8.0**

- Import of DFD data
- Serialisation(s) of DFD data
- Consider adding a generic search config

**Version 0.9.0**

- Make import generic
- Make serialisation(s) generic

**Version 1.0.0**

- Add testing
- Finish documentation
