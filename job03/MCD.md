# MCD - draft-shop

## Entités

### Category

- id (PK)
- name
- description
- createdAt
- updatedAt

### Product

- id (PK)
- name
- photos
- price
- description
- quantity
- createdAt
- updatedAt
- category_id (FK → Category.id)

<!--
N'apparait pas dans un MCD :
## Relation

Un produit appartient à une catégorie (1,n)
-->
