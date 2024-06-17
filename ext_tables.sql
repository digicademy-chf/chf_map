# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfmap_domain_model_coordinates (
    longitude varchar(255) DEFAULT '' NOT NULL,
    latitude varchar(255) DEFAULT '' NOT NULL,
    altitude varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfmap_domain_model_feature (
    title varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfmap_domain_model_tile (
    title varchar(255) DEFAULT '' NOT NULL
);
