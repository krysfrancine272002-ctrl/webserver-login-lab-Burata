-- Create table
CREATE TABLE IF NOT EXISTS users1 (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL
);

INSERT INTO users1 (username, password, fullname) 
VALUES 
('krys', '$2y$12$LlhK94VBgUCUrSXKa6h2IuHduxDKBDaAXYu1fMn4b6cUMN90Rki/W', 'Krys francine burata'),
('krysfrancine', '$2y$12$OtR5zl3kVzEWigXgicFps.Y6ZbIWO.KobzXCCuwGsCHwbeAtKA5Aq', 'Krys francine burata'),
('francine', '$2y$12$Pz1BOnZN.B.GPbgx/2p9COL7jKyicQvPnAcwrPafgy/FlbcbN9HR.', 'Francine Burata');