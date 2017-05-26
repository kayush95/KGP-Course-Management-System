<?php
include('helper_modules.php');

 $cid1 = populate_course("Linear Algebra","Mathematics",1,"2008-11-11","Linear algebra is the branch of mathematics concerning vector spaces and linear mappings between such spaces. It includes the study of lines, planes, and subspaces, but is also concerned with properties common to all vector spaces.","Basic Mathematics",500);

	 	$tid1 = populate_topics($cid1, "Linear Equations");
				$stid1_1 = populate_subtopics($tid1, "System of linear Equations");

							populate_lectures($stid1_1,'Batman v Superman','https://www.youtube.com/embed/eX_iASz1Si8',"Batman v Superman Dawn of Justice Official Final Trailer (2016) - Ben Affleck Superhero Movie HD Fearing the actions of a god-like Super Hero left unchecked, Gotham City\'s own formidable, forceful vigilante takes on Metropolis\' most revered, modern-day savior, while the world wrestles with what sort of hero it really needs. And with Batman and Superman at war with one another, a new threat quickly arises, putting mankind in greater danger than it\'s ever known before. The Fandango MOVIECLIPS Trailers channel is your destination for the hottest new trailers the second they drop. Whether it\'s the latest studio release, an indie horror flick, an evocative documentary, or that new RomCom you\'ve been waiting for, the Fandango MOVIECLIPS team is here day and night to make sure all the best new movie trailers are here for you the moment they\'re released. In addition to being the #1 Movie Trailers Channel on YouTube, we deliver amazing and engaging original videos each week. Watch our exclusive Ultimate Trailers, Showdowns, Instant Trailer Reviews, Monthly MashUps, Movie News, and so much more to keep you in the know. ",1,"");

							populate_lectures($stid1_1,'Daredevil Season 2','https://www.youtube.com/embed/2Cn3DVV0LHY',"Just when Matt thinks he is bringing order back to the city, new forces are rising in Hell’s Kitchen. Now the Man Without Fear must take on a new adversary in Frank Castle and face an old flame – Elektra Natchios.

						                                                                                Bigger problems emerge when Frank Castle, a man looking for vengeance, is reborn as The Punisher, a man who takes justice into his own hands in Matt’s neighborhood. Meanwhile, Matt must balance his duty to his community as a lawyer and his dangerous life as the Devil of Hell’s Kitchen, facing a life-altering choice that forces him to truly understand what it means to be a hero.",2,"");

							populate_lectures($stid1_1,'Deadpool Movie','https://www.youtube.com/embed/ZIM1HydF9UA',"Based upon Marvel Comics’ most unconventional anti-hero, DEADPOOL tells the origin story of former Special Forces operative turned mercenary Wade Wilson, who after being subjected to a rogue experiment that leaves him with accelerated healing powers, adopts the alter ego Deadpool. Armed with his new abilities and a dark, twisted sense of humor, Deadpool hunts down the man who nearly destroyed his life.

						                                                                                Cast: Ryan Reynolds, Morena Baccarin, Ed Skrein, T.J. Miller, Gina Carano, Brianna Hildebrand",1,"");

				$stid1_2 = populate_subtopics($tid1, "Determinants");
				$stid1_3 = populate_subtopics($tid1, "Cramer\'s Rule");
				$stid1_4 = populate_subtopics($tid1, "Gaussian Elimination");
				$stid1_5 = populate_subtopics($tid1, "Gauss-Jordan Elimination");
				$stid1_6 = populate_subtopics($tid1, "Strassen Algorithm");
		$tid2 = populate_topics($cid1, "Matrices");
				$stid2_1 = populate_subtopics($tid2, "2x2 Real Matrices");
				$stid2_2 = populate_subtopics($tid2, "Matrix theory");
				$stid2_3 = populate_subtopics($tid2, "Matrix Addition");
				$stid2_4 = populate_subtopics($tid2, "Matrix Multiplication");
				$stid2_5 = populate_subtopics($tid2, "Basis Transformation Matrix");
				$stid2_6 = populate_subtopics($tid2, "Characteristic Polynomial");
				$stid2_7 = populate_subtopics($tid2, "Trace");
				$stid2_8 = populate_subtopics($tid2, "Eigenvalue, Eigenvector, Eigenspace");
				$stid2_9 = populate_subtopics($tid2, "Rank");
				$stid2_10 = populate_subtopics($tid2, "Matrix Inversion & Invertible Matrices");
				$stid2_11 = populate_subtopics($tid2, "Adjugate");
				$stid2_12 = populate_subtopics($tid2, "Transpose");
				$stid2_13 = populate_subtopics($tid2, "Positive definite, positive semi-definite matrices");
				$stid2_14 = populate_subtopics($tid2, "Plaffian");
				$stid2_15 = populate_subtopics($tid2, "Projection");
				$stid2_16 = populate_subtopics($tid2, "Spectral Theorem");
				$stid2_17 = populate_subtopics($tid2, "Perron Frobenius Theorem");
				$stid2_18 = populate_subtopics($tid2, "List of Matrices");
		$tid3 = populate_topics($cid1, "Matrix Decompositions");
				$stid3_1 = populate_subtopics($tid3, "Cholesky Decomposition");
				$stid3_2 = populate_subtopics($tid3, "LU Decomposition");
				$stid3_3 = populate_subtopics($tid3, "QR Decomposition");
				$stid3_4 = populate_subtopics($tid3, "Polar Decomposition");
				$stid3_5 = populate_subtopics($tid3, "Spectral Theorem");
				$stid3_6 = populate_subtopics($tid3, "Singular Value Decomposition");
				$stid3_7 = populate_subtopics($tid3, "Schur Decomposition");
		$tid4 = populate_topics($cid1, "Relations");
				$stid4_1 = populate_subtopics($tid4, "Matrix Equivalence");
				$stid4_2 = populate_subtopics($tid4, "Matrix Congruence");
				$stid4_3 = populate_subtopics($tid4, "Matrix Similarity");
				$stid4_4 = populate_subtopics($tid4, "Matrix Cosimilarity");
				$stid4_5 = populate_subtopics($tid4, "Row Equivalence");
		$tid5 = populate_topics($cid1, "Computations");
		$tid6 = populate_topics($cid1, "Vector Spaces");
		$tid7 = populate_topics($cid1, "Structures");
		$tid8 = populate_topics($cid1, "Multilinear Algebra");
		$tid9 = populate_topics($cid1, "Affine Space & related topics");
		$tid10 = populate_topics($cid1, "Projective Space");

 $cid2 = populate_course("Trigonometry","Mathematics",1,"2014-09-03","Trigonometry (from Greek trigōnon, \"triangle\" and metron, \"measure\") is a branch of mathematics that studies relationships involving lengths and angles of triangles. The field emerged in the Hellenistic world during the 3rd century BC from applications of geometry to astronomical studies.","Basic Mathematics",200);

 $cid3 = populate_course("Algorithms",("Computer Science,Mathematics"),1,"2004-03-04","In mathematics and computer science, an algorithm ( i/ˈælɡərɪðəm/ AL-gə-ri-dhəm) is a self-contained step-by-step set of operations to be performed. Algorithms exist that perform calculation, data processing, and automated reasoning.","Basic CS & Maths",1000);

 $cid4 = populate_course("Proteins & Biomolecules",("Biology,Chemistry"),1,"2010-01-06","A biomolecule or biological molecule is any molecule that is present in living organisms, including large macromolecules such as proteins, carbohydrates, lipids, and nucleic acids, as well as small molecules such as primary metabolites, secondary metabolites, and natural products. A more general name for this class of material is biological materials. Biomolecules are usually endogenous but may also be exogenous. For example, pharmaceutical drugs may be natural products or semisynthetic (biopharmaceuticals) or they may be totally synthetic.","Basic BIO",60);


	accept_course(get_fac_id(2),$cid1);
	accept_course(get_fac_id(2),$cid2);
	accept_course(get_fac_id(2),$cid3);
	accept_course(get_fac_id(2),$cid4);


	exit();
?>
