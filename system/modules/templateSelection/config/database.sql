-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- 
-- Table `tl_layout`
-- 

CREATE TABLE `tl_theme` (
  `templateSelection` blob NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_page` (
  `ts_include_selection` char(1) NOT NULL default '',
  `ts_selection` blob NULL,
  `ts_include_selection_noinherit` char(1) NOT NULL default '',
  `ts_selection_noinherit` blob NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;