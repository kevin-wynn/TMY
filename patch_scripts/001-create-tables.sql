CREATE TABLE IF NOT EXISTS movies (
    movie_id int(11) NOT NULL auto_increment,
    PRIMARY KEY (movie_id),
    moviedb_id int,
    movie_title varchar(255),
    overview text,
    director varchar(255),
    cast varchar(255),
    poster_path varchar(255),
    poster2_path varchar(255),
    backdrop_path varchar(255),
    backdrop2_path varchar(255),
    backdrop3_path varchar(255),
    score int,
    review text,
    release_date varchar(255),
    publish_date varchar(255),
    featured boolean NOT NULL DEFAULT 0,
    popular_vote varchar(255),
    genre varchar(255),
    trailer varchar(255)
  );

CREATE TABLE IF NOT EXISTS discovery (
    discovery_id int(11) NOT NULL auto_increment,
    PRIMARY KEY (discovery_id),
    moviedb_id int,
    movie_title varchar(255),
    overview text,
    director varchar(255),
    cast varchar(255),
    poster_path varchar(255),
    backdrop_path varchar(255),
    release_date varchar(255),
    featured boolean,
    popular_vote varchar(255),
    genre varchar(255),
    trailer varchar(255)
  );

CREATE TABLE IF NOT EXISTS nowplaying (
    nowplaying_id int(11) NOT NULL auto_increment,
    PRIMARY KEY (nowplaying_id),
    moviedb_id int,
    movie_title varchar(255),
    overview text,
    director varchar(255),
    cast varchar(255),
    poster_path varchar(255),
    backdrop_path varchar(255),
    release_date varchar(255),
    featured boolean,
    popular_vote varchar(255),
    genre varchar(255),
    trailer varchar(255),
    view_on_home boolean default 0
  );

  CREATE TABLE IF NOT EXISTS users (
    user_id int(11) NOT NULL auto_increment,
    username varchar(100) NOT NULL,
    password char(128) NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE KEY username (username),
    email varchar(255) NOT NULL,
    permissions int,
    last_login DATE,
    url_slug varchar(255),
    f_name varchar(128),
    l_name varchar(128),
    headshot varchar(1000),
    signup_date DATE
  );
