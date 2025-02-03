# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chfbase_domain_model_location_feature_geodata_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_location_resource_floorplan_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfmap_domain_model_feature_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfmap_domain_model_distribution_feature_feature_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);
