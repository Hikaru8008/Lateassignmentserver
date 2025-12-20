CREATE TABLE IF NOT EXISTS cards(
user_id INT PRIMARY KEY,
card_name VARCHAR(50),
card_rarity INT NULL
);

CREATE TABLE user_cards (
    user_card_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    card_id INT,
    in_team TINYINT DEFAULT 0   
);



 
INSERT INTO cards (card_id, card_name, next_card_id) VALUES
(1, 'ノーマルカード', 2),
(2, 'レアカード', 3),
(3, '超レアカード', NULL);


INSERT INTO user_cards (user_id, card_id, in_team) VALUES
(1, 1, 0),
(1, 1, 0),
(1, 1, 0),
(1, 2, 1);