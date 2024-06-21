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

# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chfmap_domain_model_feature_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfmap_domain_model_relation_feature_feature_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);
