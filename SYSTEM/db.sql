CREATE DATABASE e_commerce;
CREATE TABLE category(
    cat_id int PRIMARY KEY,
    cat_name varchar(250),
    cat_description varchar(250)
)
CREATE TABLE subCategory(
    subcat_id int PRIMARY KEY,
    subcat_categoria int FOREIGN KEY category( cat_id ),
    subcat_name varchar(250),
    subcat_description varchar(250)
)