
CREATE TABLE IF NOT EXISTS `books` (
  `bid` int(11) NOT NULL auto_increment,
  `isbn` bigint(20) NOT NULL,
  `uid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `pages` int(4) NOT NULL,
  `price` int(5) NOT NULL,
  `description` text NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date` varchar(12) NOT NULL,
  `memprice` int(11) NOT NULL,
  `binding` varchar(50) NOT NULL,
  `condition` varchar(10) NOT NULL,
  `tags` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(9) NOT NULL,
  `reby` int(11) NOT NULL,
  `live` tinyint(4) NOT NULL,
  `cover_uploaded` tinyint(4) NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `isbn`, `uid`, `email`, `title`, `author`, `pages`, `price`, `description`, `comment`, `date`, `memprice`, `binding`, `condition`, `tags`, `category_id`, `status`, `reby`, `live`, `cover_uploaded`) VALUES
(58, 672300389, 8, 'aman', '10 minute guide to Harvard Graphics for Windows', 'Lisa A. Bucki', 0, 1104, '', '', '', 0, '', '', '', 3, 'available', 0, 1, 0),
(59, 3039106090, 8, 'aroraaman2709@gmail.com', '(e) pedagogy', 'Stefan Sonvilla-Weiss', 3, 9338, '', '', '', 0, '', '', '', 3, 'available', 0, 1, 0),
(60, 1111111111, 10, 'aman@thetechaddicts.com', 'Something', 'Someone', 1123, 525, 'This is the description of some book.', '', '', 0, '', 'Good', 'Arts', 1, 'available', 0, 1, 0),
(61, 1234567890, 10, 'aman@thetechaddicts.com', 'Title', 'Author', 200, 2000, 'This is the description of the books whose titles is title and author is author.', '', '', 0, '', 'Good', 'tag', 2, 'available', 0, 1, 0),
(62, 3456789209, 10, 'aman@thetechaddicts.com', 'Test Book', 'Test Author', 123, 2000, 'This is the description of this test book which has a test title and test author, eheheh how funny', '', '', 0, '', '', 'tag', 3, 'available', 0, 1, 0),
(63, 3039106090, 10, 'aman@thetechaddicts.com', '(e)pedagogy', 'Stefan Sonvilla-Weiss', 246, 3404, 'The book intends to illuminate scientific and programmatic excerpts from an international community of researchers, practitioners, teachers and scholars working ...', 'this is my comment', '2005', 3000, 'Good', 'Good', 'tag', 1, 'available', 0, 1, 0),
(64, 590353403, 10, 'aroraaman2709@gmail.com', 'Read on-- fantasy fiction', 'Neil Hollands', 0, 400, 'Arthur A. Levine, ISBN: 0590353403, 309p. (hbk.) Zelazny, Roger Chronicles of \r\nAmber. Ten books in one omnibus. The Great Book of Amber. 1 970- 1 99 1 . ...', '', '29-12-1990', 200, '', 'Good', '', 1, 'available', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `no_of_books` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `no_of_books`) VALUES
(1, 'Arts Photography & Design', 0),
(2, 'Biographies & Autobiographies', 0),
(3, 'Business, Investing and Mgmt.', 0),
(4, 'Children & Teens', 0),
(5, 'Comics & Graphic Novel', 0),
(6, 'Computers & Internet', 0),
(7, 'Crafts & Hobbies', 0),
(8, 'History & Politics', 0),
(9, 'Health & Fitness', 0),
(11, 'Humor', 0),
(12, 'Literature & Fiction', 0),
(13, 'Music, Film & Entertainment', 0),
(14, 'Families & Relationships', 0),
(15, 'Philosophy', 0),
(16, 'Reference', 0),
(17, 'Religious & Spirituality', 0),
(18, 'Science & Technology', 0),
(19, 'Self-help', 0),
(20, 'Educational & Professional', 0),
(21, 'Outdoors & Nature', 0),
(22, 'Print On Demand', 0),
(23, 'Other', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `sent_time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `subject`, `body`, `sent_time`) VALUES
(1, 1, 1, 'tst', 'test', '2011-08-23 08:46:10'),
(2, 2, 2, 'Subject', 'This is the body of th message', '0000-00-00 00:00:00'),
(3, 2, 2, 'Subject', 'This is the body of th message', '2011-08-23 08:56:23'),
(4, 9, 10, 'This is the subject', 'This is the body of the message sent to aman@thetechaddicts.com', '2011-08-24 19:40:47'),
(5, 10, 10, 'Subject', 'This is the body of the message send to some book seller', '2011-08-25 22:15:43'),
(6, 10, 10, 'This is a subject', 'This is a message', '2011-08-25 22:17:16'),
(7, 10, 0, 'Question about yout book', 'I have a little query about the book you selling', '2012-02-01 19:49:56'),
(8, 10, 0, 'query subject', 'query', '2012-02-01 19:52:35'),
(9, 10, 10, 'testing again', 'test', '2012-02-01 19:55:06'),
(10, 10, 10, 'Question about yout book', 'little query', '2012-02-01 19:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL auto_increment,
  `review_by` int(11) NOT NULL,
  `review_for` int(11) NOT NULL,
  `review` varchar(150) NOT NULL,
  `type` varchar(8) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `review_by`, `review_for`, `review`, `type`) VALUES
(1, 10, 7, 'gjhfgjhfhfh', 'positive'),
(2, 10, 7, 'another review', 'negative'),
(3, 10, 7, 'this is a neutral review', 'neutral'),
(4, 10, 7, 'this is anegative reputations', 'negative'),
(5, 10, 7, 'this is a positive review', 'positive'),
(6, 10, 7, 'this is another positive review', 'positive'),
(7, 10, 8, 'This is a review', 'positive'),
(8, 10, 8, 'neutral review', 'neutral'),
(9, 10, 8, ' fjhfghfhgfhgfg', 'negative'),
(10, 10, 8, 'jdjgdgfdhgdfg', 'negative');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`username`, `password`) VALUES
('aman', '12345'),
('aman', '12345'),
('html', '45678'),
('html', '45678'),
('html', '45678'),
('html', '45678'),
('&lt;script&gt;alert(''XSS'')&lt;/script&gt;', '45678'),
('&lt;script&gt;alert(''XSS'')&lt;/script&gt;', '45678');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hashed_password` varchar(50) NOT NULL,
  `registration_date` datetime NOT NULL,
  `mob_number` varchar(10) NOT NULL,
  `mob_active` tinyint(1) NOT NULL,
  `mob_verification_code` int(5) NOT NULL,
  `activation_key` varchar(100) NOT NULL,
  `status` varchar(9) NOT NULL,
  `ship_name` varchar(100) NOT NULL,
  `ship_city` varchar(50) NOT NULL,
  `ship_address` varchar(100) NOT NULL,
  `ship_state` varchar(50) NOT NULL,
  `ship_pincode` int(15) NOT NULL,
  `ship_phn_number` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `email`, `hashed_password`, `registration_date`, `mob_number`, `mob_active`, `mob_verification_code`, `activation_key`, `status`, `ship_name`, `ship_city`, `ship_address`, `ship_state`, `ship_pincode`, `ship_phn_number`) VALUES
(10, 'amanarora', 'Aman', 'Arora', 'aroraaman2709@gmail.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-08-27 15:51:54', '8860863565', 0, 23389, '', 'activated', 'Aman Arora', 'Gurgaon', '223/4 Model Town', 'Haryana', 122001, 2147483647),
(13, 'amanarora2709', 'Aman', 'Arora', 'aman@thetechaddicts.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-08-27 19:45:57', '2147483647', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(14, 'abcd', 'ab', 'cd', 'aroraaman2709@gmail.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-08-27 19:48:15', '8860863565', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(15, 'aman', 'Aman', 'Arora', 'aroraaman2709@gmail.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-08-27 19:49:13', '8860863565', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(16, 'amana', 'a', 'a', 'aroraaman2709@gmail.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-08-27 19:51:56', '8860863565', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(17, 'a', 'a', 'a', 'a@a.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '2011-08-27 20:29:21', 'm', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(18, 'xyz', 'Aman', 'Arora', 'aman@thetechaddicts.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-08-27 20:39:21', '8860863565', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(19, 'asdf', 'a', 'a', 'a@a.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '2011-08-27 20:49:08', 'a', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(20, '', '', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2011-08-27 21:47:10', 'a', 0, 0, '2719297781334582183607942016467010394364932302', 'verify', '', '', '', '', 0, 0),
(21, 'aman098', '', '', 'aroraaman2709@gmail.com', 'f25ec025ceb7d58e6abd1bdb99ff301a0deb713b', '2011-11-04 20:09:15', '', 0, 0, '197748081100610332217336232571282608538258231057', 'verify', '', '', '', '', 0, 0),
(22, 'demoaccount', '', '', 'aroraaman2709@gmail.com', '21e3453711c3e5b56a0989efd81d40c299901821', '2012-02-26 00:55:04', '', 0, 0, '', 'activated', '', '', '', '', 0, 0),
(23, 'demouser', '', '', 'aroraaman2709@gmail.com', '39babc332b412604066644a894d9f47b8fe2ad42', '2012-12-04 04:35:07', '', 0, 0, '', 'activated', '', '', '', '', 0, 0);
