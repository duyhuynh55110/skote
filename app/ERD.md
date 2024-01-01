``` mermaid
erDiagram
    END_USERS {
        ID id PK
        STRING uid "UQ NN"
        STRING phone_number "UQ NN"
    }

    BRANDS {
        ID id PK 
        STRING slug_name "UQ NN"
        STRING name_en "NN"
        STRING name_vi
        STRING logo_file_name "UQ NN"
    }

    PRODUCTS {
        ID id PK
        INT brand_id FK "NN"
        STRING slug_name "UQ NN"
        STRING name_en "NN"
        STRING name_vi
        STRING image_file_name "UQ NN"
        DECIMAL item_price "NN"
        STRING description
        DECIMAL summary_rating "NN"
        INT count_rating "NN"
    }

    CATEGORIES {
        ID id PK
        STRING slug_name "UQ NN"
        STRING name_en "NN"
        STRING name_vi 
        STRING image_file_name "UQ NN"
    }

    CATEGORY_PRODUCTS {
        ID id PK
        INT product_id FK "NN"
        INT category_id FK "NN"
    }

    %% BRANDS relations
    BRANDS ||--o{ PRODUCTS: hasMany

    %% PRODUCTS relations
    PRODUCTS ||--o{ CATEGORY_PRODUCTS: hasMany

    %% CATEGORIES relations
    CATEGORIES ||--o{ CATEGORY_PRODUCTS: hasMany
```
