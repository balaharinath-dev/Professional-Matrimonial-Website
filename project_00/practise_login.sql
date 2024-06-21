-- Database: `practise_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `sfid` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `midname` varchar(200) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bloodgroup` varchar(255) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `age` bigint(20) DEFAULT NULL,
  `martialstatus` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `community` varchar(255) DEFAULT NULL,
  `caste` varchar(255) DEFAULT NULL,
  `mobcode` varchar(200) NOT NULL,
  `mobno` varchar(255) DEFAULT NULL,
  `instaid` varchar(255) DEFAULT NULL,
  `doorno` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `native` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `highestqualification` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `annualincome` bigint(20) DEFAULT NULL,
  `fathersname` varchar(255) DEFAULT NULL,
  `mothersname` varchar(255) DEFAULT NULL,
  `siblingno` bigint(20) DEFAULT NULL,
  `smoking` varchar(255) DEFAULT NULL,
  `hobbies` varchar(500) DEFAULT NULL,
  `dietarypref` varchar(255) DEFAULT NULL,
  `partneragerange` bigint(20) DEFAULT NULL,
  `partnerageend` bigint(20) DEFAULT NULL,
  `partnereduucation` varchar(255) DEFAULT NULL,
  `partnerjob` varchar(255) DEFAULT NULL,
  `partneranincome` bigint(20) DEFAULT NULL,
  `partnerincomeend` bigint(20) DEFAULT NULL,
  `otherpref` varchar(500) DEFAULT NULL,
  `horoscope` varchar(255) DEFAULT NULL,
  `abouturself` varchar(500) DEFAULT NULL,
  `photo` longtext NOT NULL,
  `photoType` text NOT NULL
)