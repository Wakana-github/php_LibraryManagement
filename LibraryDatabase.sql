DROP DATABASE IF EXISTS Library;

CREATE DATABASE Library;

USE Library;

CREATE TABLE Books (
    BookID INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ISBN VARCHAR(15) NOT NULL,
    Title VARCHAR(60) NOT NULL,
    Author VARCHAR(50) NOT NULL,
    BookTypeID VARCHAR(1) NOT NULL,
    Price DECIMAL(5, 2) NOT NULL
);
INSERT INTO Books (BookID, ISBN, Title, Author, BookTypeID, Price) VALUES
 (1, '0-672-32672-8',  'PHP and MySQL Web Development',           'Welling and Thomson', 'S', 74.99),
 (2, '0-672-32725-2',  'PHP, MySQL and Apache',                   'Meloni',              'S', 49.99),
 (3, '978-1451648539', 'Steve Jobs',                              'Isaacson W',          'H', 39.99),
 (4, '978-0440201328', 'SpyCatcher',                              'Wright P',            'H',  4.99),
 (5, '978-1400079988', 'War and Peace',                           'Tolstoy L',           'S', 12.97),
 (6, '978-0345391803', 'The Hitchhikers Guide to the Galaxy',     'Adams D',             'S',  7.19),
 (7, '978-0001720299', 'Lion, the Witch and the Wardrobe',        'Lewis C.S.',          'H', 46.98),
 (8, 'B005Q0TIO8',     'Frankenstein',                            'Shelley M',           'D',  0.00),
 (9, '978-1447284581', 'The Gruffalo',                            'Donaldson J',         'H', 10.80),
(10, 'B-00I-5PWX5-M',  'Clear and Present Danger: Jack Ryan',     'Clancy T',            'D',  0.00),
(11, '1-631-46672-0',  'Unwanted',                                'Stringer',            'S', 27.99),
(12, '0-963-70580-6',  'Alfies Home',                             'Cohen',               'H', 27.99),
(13, '0-997-63730-7',  'The Joy of Water Boiling',                'Nicolosi',            'D', 35.00),
(14, '1-620-23598-6',  'Catflexing: A catlover\'s Guide to weightlifting', 'Carpenter',   'D', 18.99),
(15, '0-877-88306-8',  'Cooking to Kill: The Poison Cook-book',   'Medinger',            'H', 49.99),
(16, '0-578-07217-3',  'How to Teach Qantum Physics to your Dog', 'Timmerman',           'S', 37.40);

DROP TABLE IF EXISTS BookTypes;
CREATE TABLE Booktypes (
  BookTypeID VARCHAR(3) PRIMARY KEY,
  BookType VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO BookTypes (BookTypeID, BookType) VALUES
  ('H', 'Hardcover'), ('S', 'Softcover'), ('D', 'Digital');
