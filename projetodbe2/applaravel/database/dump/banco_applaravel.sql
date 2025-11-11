--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

-- Started on 2025-11-10 21:30:49

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 224 (class 1259 OID 25842)
-- Name: enderecos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enderecos (
    id bigint NOT NULL,
    cep character(8) NOT NULL,
    logradouro character varying(100) NOT NULL,
    numero integer NOT NULL,
    complemento character varying(50),
    bairro character varying(50) NOT NULL,
    cidade character varying(50) NOT NULL,
    estado character(2) NOT NULL,
    pais character varying(30) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);

CREATE TABLE public.monitoramentos (
    id bigint NOT NULL,
    dt_monitoramento date NOT NULL,
    hora_monitoramento time(0) without time zone NOT NULL,
    tipo character varying(255) NOT NULL,
    observacoes text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT monitoramentos_tipo_check CHECK (((tipo)::text = ANY ((ARRAY['Diabetes'::character varying, 'Hipertensao'::character varying, 'Outra'::character varying])::text[])))
);

CREATE TABLE public.usuarios (
    id bigint NOT NULL,
    nomeusuario character varying(255) NOT NULL,
    dtnasc date NOT NULL,
    sexo character(1) NOT NULL,
    cpf character(11) NOT NULL,
    telefone character varying(15) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    tipo_usuario character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    datacadastro timestamp(0) without time zone NOT NULL,
    imagem character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT usuarios_tipo_usuario_check CHECK (((tipo_usuario)::text = ANY ((ARRAY['paciente'::character varying, 'profissional'::character varying, 'administrador'::character varying])::text[])))
);