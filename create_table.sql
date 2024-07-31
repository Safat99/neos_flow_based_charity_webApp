-- public.donation_codes definition

-- Drop table

-- DROP TABLE public.donation_codes;

CREATE TABLE public.donation_codes (
	id int4 NOT NULL,
	code varchar(255) NOT NULL,
	isused bool NOT NULL,
	CONSTRAINT donation_codes_pkey PRIMARY KEY (id)
);
CREATE UNIQUE INDEX uniq_3e079bb077153098 ON public.donation_codes USING btree (code);


-- public.organizations definition

-- Drop table

-- DROP TABLE public.organizations;

CREATE TABLE public.organizations (
	id int4 NOT NULL,
	"name" varchar(255) NOT NULL,
	description text NULL,
	imageurl varchar(255) DEFAULT NULL::character varying NULL,
	link varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT organizations_pkey PRIMARY KEY (id)
);
CREATE UNIQUE INDEX uniq_427c1c7f5e237e06 ON public.organizations USING btree (name);


-- public.charity_donation definition

-- Drop table

-- DROP TABLE public.charity_donation;

CREATE TABLE public.charity_donation (
	id int4 NOT NULL,
	organization_id int4 NOT NULL,
	donation_code_id int4 NOT NULL,
	"date" timestamp(0) NOT NULL,
	CONSTRAINT charity_donation_pkey PRIMARY KEY (id),
	CONSTRAINT fk_b28f550032c8a3de FOREIGN KEY (organization_id) REFERENCES public.organizations(id),
	CONSTRAINT fk_b28f5500d7602a7 FOREIGN KEY (donation_code_id) REFERENCES public.donation_codes(id)
);
CREATE INDEX idx_b28f550032c8a3de ON public.charity_donation USING btree (organization_id);
CREATE INDEX idx_b28f5500d7602a7 ON public.charity_donation USING btree (donation_code_id);