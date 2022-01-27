-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 12:42 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dms_dayiarydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dms_admin_table`
--

CREATE TABLE `dms_admin_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dms_admin_table`
--

INSERT INTO `dms_admin_table` (`ID`, `USERNAME`, `PASSWORD`, `CREATED_AT`) VALUES
(1, 'sysadmin', '$2y$10$8DjKYP81mUG6emuvTeC9h.xMoJ/7hkyRsVq9rugW/zKH7L7rzRyKm', '2021-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `dms_diary_table`
--

CREATE TABLE `dms_diary_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USER_ID` bigint(20) NOT NULL,
  `CONTENT` varchar(10000) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dms_diary_table`
--

INSERT INTO `dms_diary_table` (`ID`, `USER_ID`, `CONTENT`, `STATUS`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(2, 3, 'I have had a good weekend. hung out with friends at the local bar on friday night, took my son and signed him up for his little league that is about to start and had lunsh with him, went out to the local bar on saturday night and somehow a conversation started with two younger realy cute girls and made me feel young again. it was very pleasant. I also worked on my projects and as usual tied to mend thing with my girl friend which i think it is going no whre and as i said before it needs to end soon becaue it is probablt better for both of us. As it is now, i dont feel like i have a girlfriend anyways because we constantly fight nd dont do anything together and are not intimate at all. She goes out wit her friends and spends the night at their house and i dont knwo if she is telling the truth or not but i do know her freinds and they are to be trusted. But tht doesnt mean that she was out with them and/or spent the night at their house. She has cheated on me before and has been caught and i dont know why i have taken her back. I am stupid, thats why. Today i am panning to go see my family and have dinner with them and maybe work a little on my projects. Work has been extremely slow and i hope that it picks up soon. This year did not start vey good at all so i guess i can look forward to the new month coming and hope that things get much better.', 'Heart', '2021-12-01', '2022-01-06'),
(3, 3, 'So a lot has happenned and a lot of good and bad things have happenned. My business has been doing great and everything has been great as far as financials goes. I have managed to outlast the bad economy and still am doing good as far as business goes. My girelfriend has been the same girfriend and believe it or not she actually has moved in with me for the past 6 months which is probably unbeleivable to everyone. My little boy has grown up as wlel and he is a little man now. But things have taken a dark turn in the past few eeks and i have been engaged in a lot of verbal fights bd by that i mean really dark and bad words and shouting matches and everything involved with my same girl friend. I dont know how to describe it but i am in a free fall and am desperately trying to hold on right now. Eveyhing bad that can possibly happen in 48 hours has happenned. My sons mom has even gotten in on it and has told me that i am not allowd to see my son anymore because i am unstable which is a bunch of balony because she doesnt even know anything about what is going on. I think time will heal and i just need to stay focused and take care of all this like a man. I will try hard to write everyday now and will get back into my diary affairs and hope that it does the same healin as it has in the past for me. I missed this and been wanting to write about my life for a long time and just havent had the time or desire to. But i am back. I love life and all that is there to offer. I just need a break right now and hope thyat everythin gwil work out. My son comes first in my life and that is my biggest worry.', 'Sad', '2021-12-02', '0000-00-00'),
(4, 3, 'It is just about Thanks Giving and times are getting worst and people are in such bad mood because of it. This economy is screwing up a lot of lives. Thank god thta so far my work has been ok and steady. Things have been ok with the exception of a few speed bumps but i am doing great and my son is doing great. My life is just turned out to be working, working, taking care of my son, working, sleeping and working in the past year. I have been exercising an dtrying to get in better shape and just want things to go right and give my son a better life. His mother is tsill th esame old careless person and i feel that i have the whole responsibility to take care of him and that is ok by me but i wish i had a little bid of help from her. I just keep on having this bad feeling that things arent gonna go right but i know that if i keep on doing what i am doing and trying harder i can reach what i want to achieve.', 'Neutral', '2021-12-03', '0000-00-00'),
(5, 3, 'I am very tired today. Didnt get much sleep at all last night. Took my son to school and went to work. Have had a busy day doing all the old work and trying to catch up. Not really making much money because of the holidays. I cant believe that his mother hasnt even called for 2 days to see if my son is ok. I spoke with my girl and everything seems to be ok but she still only wants to be friends which is ok by me right now because there are many thing s going on . She is still sick and i am trying to help her as much as i can to make her feel better. She is so cute when she is sick. Like a little girl.', 'Sad', '2021-12-04', '0000-00-00'),
(6, 3, 'Picked up my son and took him to school. He was a little upset because he said that his step dad told him that when they move to that ghetto neighborhood he wont see me as much. Maybe 2 days a week and he will spend the nights there with them. My son told me that he wants to live with me and get away from them and doesnt want to move there. I can see that it is bothering him. I assured him that he will see me all the time and stay with me because him mom and step dad have to work all day and are now even further away from work. He says that keep on telling him that he is a spoiled brat and i made him that way and take his stuff. My son told me that his sister got into a fight with the step dad and he packed up her things and told her to get out of there and his mom backed him up so his sister hasnt been back for a week now. I just dont understand what their problem is. If he is having issues, kids shouldnt be paying for it. I will keep him over night to make him feel better. I met with his teacher and she told me how much potential he has and that he is very smart and can easily get As even if he barely tried. I was very impressed. I have a msile on my face just even thinking about him. He is my little man. Talk to my girl as well and she is coming over later on as well for dinner.', 'Neutral', '2021-12-05', '0000-00-00'),
(7, 3, 'I woke up and took my son and took him to school. Worked all day and then picked him up from school. i have a meeting with his teacher tomorrow and he is a little nervous about that but i know that it will be fine. I dropped him off at his moms at 6:30 when they got home from work and had to do some more work.', 'Happy', '2021-12-06', '0000-00-00'),
(9, 3, 'woke up at my new place and loved it. went to work and worked all day. talked to my girl and we just said to forget about the day before. It went pretty well. i am tired and will go home to get some rest. Spoke to my son today and he said that his step dad is in a bad mood and is yelling at him all day.', 'Sad', '2021-12-08', '0000-00-00'),
(10, 3, 'Woke up today and was in the moving zone. I got all my stuff packed and picked up my son and he helped me move all out stuff to the new place. We have a great new place twice as big as our old one with pool, Jacuzzi, work out room, walk in closet, and secure underneath parking, Sauna, and great view from the balcony as well ass all new appliances and carpet. I love it and my son is SOOOOO excited. All day i was moving and cleaning. OH YEAH, did i mentioned i have my own washer and dryer and i love it. I washed and washed and put everything and away and cleaned and now i am going to sell my TV and buy a Flat screen digital TV and my place will be complete and awesome looking. I cant wait. I also went to my storage unit and picked my kitchen furniture with my son and brought them over so i need to do some grocery shopping now. i went over my girls house at night to spend the night there. We are getting closer to each other but as friends which i dont mind because i just want t be with her and near her. we had dinner and just went online and started Christmas shopping and had some drinks and she started getting a little mean (i understand that she is in a bad mood because she is sick but come on) so i ended up leaving and went over to my new place and spent my first night there. It was great and i loved it.', 'Heart', '2021-12-09', '0000-00-00'),
(11, 3, 'Woke up today and gave my son a ride to school. Got back to the office and got some work done. Was very serious all day and wanted to get some stuff done. Spoke to my girl and she told me that we could see each other. I picked up my sons mom at 1 from Downtown to give her a ride home because she called and said that she didnt feel good. I saw an opportunity to talk to her about our son and we got into a huge argument about him being tired in school and she said that she tells him to go to sleep at 9 and then she goes to sleep and she has no control over him being up. That is the lamest excuse i have ever heard. She said that she was glad that he got bad grades because it is his attitude and that he is too cocky and that is why he didnt listen in class and didnt do his homework. She actually said that she was glad that he got bad grades. I couldnt believe my ears and just went off on her told her how bad of a mother she could be sometimes. This is nothing that anyone should ever blame their son on if they know that it is them and their actions. She knows very well that my son just doesnt really like it there and wants to be with me because he sees a light at the end of the tunnel with me and his life is much better and cared for and it is bugging her. Well good, i hope it does. Anyways, i hope this all turns out to be a good thing and helps me and my son. ', 'Neutral', '2021-12-10', '0000-00-00'),
(12, 3, 'I feel much better today. I think I am almost done with this cold. So I picked up my son this morning. I dropped him off last night at his moms so he hopefully will get a speech from them as well because I let her have it last night and let her know that whatever is happening at her house is dragging him down with his school performance. I told her that he goes to bed at my place no later than 9 p.m. and does all the things that he is suppose to. I also let her know that he needs to have his homework checked when he is over there like I do and make sure all school work is done correctly because that is one of the complaints. She told me I go t bed at 9 p.m. and tell him to go to school. He stays up and I cant see if he is actually going to sleep or not. That is the worst excuse I have ever heard. Oh yes, I went to sleep officer at 9 p.m. and didnt know my son was going to go out and do drugs and join a gang and be up to no good because I was asleep and sleep is everything to me. You have got to be kidding me. It is bad enough to neglect your son and not see him the whole day, but when you get home you still continue to do the same and then go to sleep and not check on his school stuff or anything. He has asked me so many times right after I give him a hug and kiss and tell him that I love him How come my mom doesnt give me hugs or kisses anymore?', 'Heart', '2021-12-11', '0000-00-00'),
(13, 3, 'I woke up this morning with still a little bid of cold symptoms. I got ready and took a shower and changed and got my son ready (he spent the night with me) and gave him breakfast and took him to school. On the way to school I got a traffic ticket which I think was just so unfair. I am definitely going to fight it in court. I then went ahead and met the new landlord to sign the lease contract and got my keys and looked around to get familiar with the place. I feel very good about it. But that ticket just started the bad day. Then I got to the office and started my daily routine of checking emails and answering emails and I received an email from a very unhappy client which I did some work for. The problem is that every once in a while u get a client that thinks they know more than they actually do and that causes problems. This was the classic case of that and it turned out and whatever I say to this client they already think they know it and so there came a point that I just had to set the boundaries and let them know that what I did and said was it in this profession and if they thought that they could do better and/or know so much then they should do it themselves. ', 'Neutral', '2021-12-12', '0000-00-00'),
(14, 3, 'Well, I am still sick today. I woke up with the whole shabang. Took my son to school and came back home and went back to sleep until 11 a.m. I woke up and didnt know where or who I was for a second. I hate it when that happens. I got my self up and ready and came to work and have been trying to get some stuff done. Phone is been ringing off the hook and it is driving me crazy. I have been a getting a lot of emails to and just cant handle it right now. I talked to my girl last night and she seems like she is a bid sick as well. I guess it is goig around. The stock market is not doing me too good either right now and my stocks shares that I own are down which is worrying me. I just want to get away. I wish that I could find someone that could take care of my son for a week and take him to school and feed him and just be there for him so I can just get away. I', 'Neutral', '2021-12-13', '0000-00-00'),
(15, 3, 'I am sick today. I woke up with a cold that I have been slowly getting. It started with my throat yesterday and today tit is my nose, throat and head. Feel awful. I picked my son up and we went for lunch at a Middle Eastern restaurant for a change. The food was great. Then we went to the guitar center so we can goof around a little. He loves that place. Then we went home and played with our guitars for a while and went out again for some ice cream. I had a great time with me. I talked to my girl and much to my surprise she said it was ok for us to meet and maybe have dinner because of my birthday. So I dropped off my son (felt pretty bad but I just need to these days) and went and picked her up. We went to a Mexican restaurant and had a great time and talked and laughed and ate.', 'Sad', '2021-12-14', '0000-00-00'),
(16, 3, 'Well, happy birthday to me. I woke up with a huge hang over. I went out last night and all the people I know kept on buying me shots. I didnt really want to do that but at least it kept me from thinking about the girl I love. I went from one bar to another in my local town. Met up with some friends that were there and met a girl that looked like a stripper. A huge Tattoo on her chest and wasnt afraid to show it. She wouldnt leave me alone and asked me to go dancing with her at another club down the street. I said I couldnt and she got mad and left. too funny! I had a couple f friends text message me and say happy birthday and thats about it. Finally at 2 a.m. I got a text from her and all it said was Happy Birthday. I guess she went out and just texted me when she got home. I dont know, maybe. It was horrible at the beginning until I took those shots. I think I texted her a few times and told her that it was so wrong of her at least not acknowledging my birthday. I was there for her at her birthday. At least I thought we were friends and that is what friends do. ', 'Heart', '2021-12-15', '0000-00-00'),
(459, 3, 'l', '', '2022-01-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `dms_user_table`
--

CREATE TABLE `dms_user_table` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `CREATED_AT` date NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dms_user_table`
--

INSERT INTO `dms_user_table` (`ID`, `USERNAME`, `EMAIL`, `PASSWORD`, `NAME`, `BIRTHDATE`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(1, 'sysuser', '', '$2y$10$nMqtMx1ToPwGk/Rc8qGrT.i09Oc2IswV37wZbyKIqFKXCneS9FGC.', 'System User', '2021-12-06', '2021-12-06', '2021-12-07'),
(2, 'selena', 'user1.selenagomez@gmail.com', '$2y$10$47QCL/s3DuUHJEsbLk4om.qBYpMtavc8ajoXj99E2k8OIJOtJ0HTG', 'selena gomez', '1992-07-22', '2022-01-06', '0000-00-00'),
(3, 'taylorrrrrrrrrrrr', 'user2.taylorswift@gmail.com', '$2y$10$4s8tsdrv.V.dvmI7h1HOm.H5E2p8CFjPoFz8MgElyZ3Cf7u5.DHF2', 'taylor swift', '1989-12-23', '2022-01-06', '0000-00-00'),
(4, 'miley', 'user3.mileycyrus@gmail.com', '$2y$10$oVY/eB679/48FPreBRQDq.gVWmf4wiQfNP2bMP3wGJHduefD9.0X2', 'miley cyrus', '1992-11-23', '2022-01-06', '0000-00-00'),
(54, 'harry', 'user4.harrystyles@gmail.com', '$2y$10$l7VskdoX3KkOnkh9CXAjJ.YXHVAOn6LoHf/qb7DAsBAPdk2Wx6ZsO', 'harry styles', '1994-02-01', '2022-01-06', '0000-00-00'),
(55, 'bruno', 'user5.brunomars@gmail.com', '$2y$10$s9EQ/w207dPhDyNOu4eqdOOlj/mGj87rh2O94bdG32ZEfpy6XL6UC', 'bruno mars', '1985-10-08', '2022-01-06', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dms_admin_table`
--
ALTER TABLE `dms_admin_table`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `dms_diary_table`
--
ALTER TABLE `dms_diary_table`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `dms_user_table`
--
ALTER TABLE `dms_user_table`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dms_admin_table`
--
ALTER TABLE `dms_admin_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dms_diary_table`
--
ALTER TABLE `dms_diary_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `dms_user_table`
--
ALTER TABLE `dms_user_table`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
