-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler version: 0.9.4
-- PostgreSQL version: 13.0
-- Project Site: pgmodeler.io
-- Model Author: ---

-- Database creation must be performed outside a multi lined SQL file. 
-- These commands were put in this file only as a convenience.
-- 
-- object: new_database | type: DATABASE --
-- DROP DATABASE IF EXISTS new_database;
CREATE DATABASE new_database;
-- ddl-end --


-- object: public."LOCALIZATION" | type: TABLE --
-- DROP TABLE IF EXISTS public."LOCALIZATION" CASCADE;
CREATE TABLE public."LOCALIZATION" (
	"ID_POINT" integer NOT NULL GENERATED ALWAYS AS IDENTITY ,
	"X" float NOT NULL,
	"Y" float NOT NULL,
	study_point boolean NOT NULL,
	country text,
	city text,
	admin_level1 text,
	admin_level2 text,
	admin_level3 text,
	admin_level4 text,
	CONSTRAINT "Localization_pk" PRIMARY KEY ("ID_POINT")
);
-- ddl-end --
COMMENT ON COLUMN public."LOCALIZATION"."X" IS E'X coordinate of the point';
-- ddl-end --
COMMENT ON COLUMN public."LOCALIZATION"."Y" IS E'Y coordinate of the point';
-- ddl-end --
COMMENT ON COLUMN public."LOCALIZATION".study_point IS E'IS th epoint used in the study';
-- ddl-end --
ALTER TABLE public."LOCALIZATION" OWNER TO postgres;
-- ddl-end --

-- object: public."OBSERVATION" | type: TABLE --
-- DROP TABLE IF EXISTS public."OBSERVATION" CASCADE;
CREATE TABLE public."OBSERVATION" (
	"ID_OBS" smallint NOT NULL GENERATED ALWAYS AS IDENTITY ,
	date_time timestamp NOT NULL,
	temperature real NOT NULL,
	humidy real NOT NULL,
	"ID_BACKYARD_BACKYARD" smallint,
	"ID_POINT_LOCALIZATION" integer NOT NULL,
	CONSTRAINT "Observation_pk" PRIMARY KEY ("ID_OBS")
);
-- ddl-end --
COMMENT ON COLUMN public."OBSERVATION".date_time IS E'Date and time of the observation';
-- ddl-end --
COMMENT ON COLUMN public."OBSERVATION".temperature IS E'Temperature (°C)';
-- ddl-end --
COMMENT ON COLUMN public."OBSERVATION".humidy IS E'Measure %';
-- ddl-end --
ALTER TABLE public."OBSERVATION" OWNER TO postgres;
-- ddl-end --

-- object: "LOCALIZATION_fk" | type: CONSTRAINT --
-- ALTER TABLE public."OBSERVATION" DROP CONSTRAINT IF EXISTS "LOCALIZATION_fk" CASCADE;
ALTER TABLE public."OBSERVATION" ADD CONSTRAINT "LOCALIZATION_fk" FOREIGN KEY ("ID_POINT_LOCALIZATION")
REFERENCES public."LOCALIZATION" ("ID_POINT") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."HOUSING" | type: TABLE --
-- DROP TABLE IF EXISTS public."HOUSING" CASCADE;
CREATE TABLE public."HOUSING" (
	"ID_HOUSING" smallint NOT NULL GENERATED ALWAYS AS IDENTITY ,
	nb_animals_house smallint,
	nb_people smallint,
	"ID_OBS_OBSERVATION" smallint,
	CONSTRAINT "Housing_pk" PRIMARY KEY ("ID_HOUSING")
);
-- ddl-end --
COMMENT ON COLUMN public."HOUSING".nb_animals_house IS E'Number of animals in the house (0->n)';
-- ddl-end --
ALTER TABLE public."HOUSING" OWNER TO postgres;
-- ddl-end --

-- object: public."BACKYARD" | type: TABLE --
-- DROP TABLE IF EXISTS public."BACKYARD" CASCADE;
CREATE TABLE public."BACKYARD" (
	"ID_BACKYARD" smallint NOT NULL GENERATED ALWAYS AS IDENTITY ,
	plants_3m boolean,
	garden boolean NOT NULL,
	plants boolean,
	nb_animals_bcky smallint NOT NULL,
	CONSTRAINT "BACKYARD_pk" PRIMARY KEY ("ID_BACKYARD")
);
-- ddl-end --
COMMENT ON COLUMN public."BACKYARD".plants_3m IS E'IS there plants up to 3 meters';
-- ddl-end --
COMMENT ON COLUMN public."BACKYARD".garden IS E'garden or artifical area';
-- ddl-end --
COMMENT ON COLUMN public."BACKYARD".plants IS E'Is there plants ?';
-- ddl-end --
COMMENT ON COLUMN public."BACKYARD".nb_animals_bcky IS E'Number of animals in the backyard (0->n)';
-- ddl-end --
ALTER TABLE public."BACKYARD" OWNER TO postgres;
-- ddl-end --

-- object: "BACKYARD_fk" | type: CONSTRAINT --
-- ALTER TABLE public."OBSERVATION" DROP CONSTRAINT IF EXISTS "BACKYARD_fk" CASCADE;
ALTER TABLE public."OBSERVATION" ADD CONSTRAINT "BACKYARD_fk" FOREIGN KEY ("ID_BACKYARD_BACKYARD")
REFERENCES public."BACKYARD" ("ID_BACKYARD") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: "OBSERVATION_uq" | type: CONSTRAINT --
-- ALTER TABLE public."OBSERVATION" DROP CONSTRAINT IF EXISTS "OBSERVATION_uq" CASCADE;
ALTER TABLE public."OBSERVATION" ADD CONSTRAINT "OBSERVATION_uq" UNIQUE ("ID_BACKYARD_BACKYARD");
-- ddl-end --

-- object: public."CONTAINER" | type: TABLE --
-- DROP TABLE IF EXISTS public."CONTAINER" CASCADE;
CREATE TABLE public."CONTAINER" (
	"ID_CONTAINER" smallint NOT NULL GENERATED ALWAYS AS IDENTITY ,
	"Inside" boolean,
	container_type text NOT NULL,
	infected boolean NOT NULL,
	"ID_OBS_OBSERVATION" smallint,
	CONSTRAINT "CONTAINER_pk" PRIMARY KEY ("ID_CONTAINER")
);
-- ddl-end --
COMMENT ON COLUMN public."CONTAINER"."Inside" IS E'True if inside\nFalse if outside';
-- ddl-end --
COMMENT ON COLUMN public."CONTAINER".infected IS E'Number of type of container';
-- ddl-end --
ALTER TABLE public."CONTAINER" OWNER TO postgres;
-- ddl-end --

-- object: "OBSERVATION_fk" | type: CONSTRAINT --
-- ALTER TABLE public."CONTAINER" DROP CONSTRAINT IF EXISTS "OBSERVATION_fk" CASCADE;
ALTER TABLE public."CONTAINER" ADD CONSTRAINT "OBSERVATION_fk" FOREIGN KEY ("ID_OBS_OBSERVATION")
REFERENCES public."OBSERVATION" ("ID_OBS") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public."LARVAE" | type: TABLE --
-- DROP TABLE IF EXISTS public."LARVAE" CASCADE;
CREATE TABLE public."LARVAE" (
	"ID_LARVAE" smallint NOT NULL,
	genus text,
	species text,
	"ID_CONTAINER_CONTAINER" smallint,
	CONSTRAINT "LARVAE_pk" PRIMARY KEY ("ID_LARVAE")
);
-- ddl-end --
ALTER TABLE public."LARVAE" OWNER TO postgres;
-- ddl-end --

-- object: "CONTAINER_fk" | type: CONSTRAINT --
-- ALTER TABLE public."LARVAE" DROP CONSTRAINT IF EXISTS "CONTAINER_fk" CASCADE;
ALTER TABLE public."LARVAE" ADD CONSTRAINT "CONTAINER_fk" FOREIGN KEY ("ID_CONTAINER_CONTAINER")
REFERENCES public."CONTAINER" ("ID_CONTAINER") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public."MOSQUITOE_SEQUENCE" | type: TABLE --
-- DROP TABLE IF EXISTS public."MOSQUITOE_SEQUENCE" CASCADE;
CREATE TABLE public."MOSQUITOE_SEQUENCE" (
	"ID_SEQUENCE" smallint NOT NULL GENERATED ALWAYS AS IDENTITY ,
	sequence text,
	accession smallint NOT NULL,
	gene_name text,
	haplotype text NOT NULL,
	"ID_LARVAE_LARVAE" smallint,
	"ID_ADULT_ADULT" integer,
	CONSTRAINT "SEQUENCE_pk" PRIMARY KEY ("ID_SEQUENCE")
);
-- ddl-end --
ALTER TABLE public."MOSQUITOE_SEQUENCE" OWNER TO postgres;
-- ddl-end --

-- object: "LARVAE_fk" | type: CONSTRAINT --
-- ALTER TABLE public."MOSQUITOE_SEQUENCE" DROP CONSTRAINT IF EXISTS "LARVAE_fk" CASCADE;
ALTER TABLE public."MOSQUITOE_SEQUENCE" ADD CONSTRAINT "LARVAE_fk" FOREIGN KEY ("ID_LARVAE_LARVAE")
REFERENCES public."LARVAE" ("ID_LARVAE") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public."VIRUS" | type: TABLE --
-- DROP TABLE IF EXISTS public."VIRUS" CASCADE;
CREATE TABLE public."VIRUS" (
	"ID_VIRUS" integer NOT NULL GENERATED ALWAYS AS IDENTITY ,
	virus_name text,
	"ID_LARVAE_LARVAE" smallint,
	"ID_ADULT_ADULT" integer,
	CONSTRAINT "VIRUS_pk" PRIMARY KEY ("ID_VIRUS")
);
-- ddl-end --
ALTER TABLE public."VIRUS" OWNER TO postgres;
-- ddl-end --

-- object: "LARVAE_fk" | type: CONSTRAINT --
-- ALTER TABLE public."VIRUS" DROP CONSTRAINT IF EXISTS "LARVAE_fk" CASCADE;
ALTER TABLE public."VIRUS" ADD CONSTRAINT "LARVAE_fk" FOREIGN KEY ("ID_LARVAE_LARVAE")
REFERENCES public."LARVAE" ("ID_LARVAE") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public."VIRUS_SEQUENCE" | type: TABLE --
-- DROP TABLE IF EXISTS public."VIRUS_SEQUENCE" CASCADE;
CREATE TABLE public."VIRUS_SEQUENCE" (
	"ID_SEQUENCE" smallint NOT NULL GENERATED ALWAYS AS IDENTITY ,
	sequence text,
	accession smallint NOT NULL,
	gene_name text,
	haplotype text,
	"ID_VIRUS_VIRUS" integer,
	CONSTRAINT "VIRUS_SEQUENCE_pk" PRIMARY KEY ("ID_SEQUENCE")
);
-- ddl-end --
ALTER TABLE public."VIRUS_SEQUENCE" OWNER TO postgres;
-- ddl-end --

-- object: "VIRUS_fk" | type: CONSTRAINT --
-- ALTER TABLE public."VIRUS_SEQUENCE" DROP CONSTRAINT IF EXISTS "VIRUS_fk" CASCADE;
ALTER TABLE public."VIRUS_SEQUENCE" ADD CONSTRAINT "VIRUS_fk" FOREIGN KEY ("ID_VIRUS_VIRUS")
REFERENCES public."VIRUS" ("ID_VIRUS") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: public."ADULT" | type: TABLE --
-- DROP TABLE IF EXISTS public."ADULT" CASCADE;
CREATE TABLE public."ADULT" (
	"ID_ADULT" integer NOT NULL GENERATED ALWAYS AS IDENTITY ,
	genus text NOT NULL,
	species smallint,
	gender text,
	inside boolean NOT NULL,
	id_box smallint,
	"ID_OBS_OBSERVATION" smallint,
	CONSTRAINT "ADULT_pk" PRIMARY KEY ("ID_ADULT")
);
-- ddl-end --
ALTER TABLE public."ADULT" OWNER TO postgres;
-- ddl-end --

-- object: "OBSERVATION_fk" | type: CONSTRAINT --
-- ALTER TABLE public."ADULT" DROP CONSTRAINT IF EXISTS "OBSERVATION_fk" CASCADE;
ALTER TABLE public."ADULT" ADD CONSTRAINT "OBSERVATION_fk" FOREIGN KEY ("ID_OBS_OBSERVATION")
REFERENCES public."OBSERVATION" ("ID_OBS") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: "ADULT_fk" | type: CONSTRAINT --
-- ALTER TABLE public."MOSQUITOE_SEQUENCE" DROP CONSTRAINT IF EXISTS "ADULT_fk" CASCADE;
ALTER TABLE public."MOSQUITOE_SEQUENCE" ADD CONSTRAINT "ADULT_fk" FOREIGN KEY ("ID_ADULT_ADULT")
REFERENCES public."ADULT" ("ID_ADULT") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: "ADULT_fk" | type: CONSTRAINT --
-- ALTER TABLE public."VIRUS" DROP CONSTRAINT IF EXISTS "ADULT_fk" CASCADE;
ALTER TABLE public."VIRUS" ADD CONSTRAINT "ADULT_fk" FOREIGN KEY ("ID_ADULT_ADULT")
REFERENCES public."ADULT" ("ID_ADULT") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: "OBSERVATION_fk" | type: CONSTRAINT --
-- ALTER TABLE public."HOUSING" DROP CONSTRAINT IF EXISTS "OBSERVATION_fk" CASCADE;
ALTER TABLE public."HOUSING" ADD CONSTRAINT "OBSERVATION_fk" FOREIGN KEY ("ID_OBS_OBSERVATION")
REFERENCES public."OBSERVATION" ("ID_OBS") MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: "HOUSING_uq" | type: CONSTRAINT --
-- ALTER TABLE public."HOUSING" DROP CONSTRAINT IF EXISTS "HOUSING_uq" CASCADE;
ALTER TABLE public."HOUSING" ADD CONSTRAINT "HOUSING_uq" UNIQUE ("ID_OBS_OBSERVATION");
-- ddl-end --


