<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use App\Entity\Show;
use App\Entity\CategoriesShow;
use App\Entity\ShowVideo;
use App\Entity\UserLectures;
use App\Entity\UserListShow;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categoriesShowData = [
            ["name" => "Action"],
            ["name" => "Comédie"],
            ["name" => "Drame"],
            ["name" => "Sci-Fi"],
            ["name" => "Horreur"],
            ["name" => "Documentaire"],
            ["name" => "Animation"],
            ["name" => "Thriller"],
        ];

        $categoriesShow = [];
        foreach ($categoriesShowData as $categoryData) {
            $category = new CategoriesShow();
            $category->setName($categoryData["name"]);
            $manager->persist($category);
            $categoriesShow[] = $category;
        }


        $showsData = [
            ["title" => "Inception", "description" => "Un voleur qui s'infiltre dans les rêves pour dérober des secrets.", "categoryIndex" => 3, "releaseDate" => "2010-07-16"],
            ["title" => "Léon", "description" => "Un tueur professionnel prend une jeune fille orpheline sous son aile.", "categoryIndex" => 2, "releaseDate" => "1994-09-14"],
            ["title" => "Alien", "description" => "L'équipage d'un vaisseau spatial est traqué par une créature extraterrestre mortelle.", "categoryIndex" => 4, "releaseDate" => "1979-06-22"],
            ["title" => "Mad Max: Fury Road", "description" => "Une course-poursuite explosive dans un désert post-apocalyptique.", "categoryIndex" => 0, "releaseDate" => "2015-05-15"],
            ["title" => "The Grand Budapest Hotel", "description" => "Les aventures burlesques d'un concierge légendaire et de son protégé.", "categoryIndex" => 1, "releaseDate" => "2014-02-26"],
            ["title" => "Le Voyage de Chihiro", "description" => "Une fillette se retrouve piégée dans un monde peuplé d'esprits.", "categoryIndex" => 6, "releaseDate" => "2001-07-20"],
            ["title" => "Se7en", "description" => "Deux détectives traquent un tueur en série inspiré par les sept péchés capitaux.", "categoryIndex" => 7, "releaseDate" => "1995-09-22"],
            ["title" => "Free Solo", "description" => "L'ascension vertigineuse d'El Capitan sans corde ni assurance.", "categoryIndex" => 5, "releaseDate" => "2018-09-28"],
            ["title" => "Interstellar", "description" => "Des astronautes voyagent à travers un trou de ver pour sauver l'humanité.", "categoryIndex" => 3, "releaseDate" => "2014-11-05"],
            ["title" => "Django Unchained", "description" => "Un esclave affranchi devenu chasseur de primes part libérer sa femme.", "categoryIndex" => 0, "releaseDate" => "2012-12-25"],
        ];

        $shows = [];
        foreach ($showsData as $showData) {
            $show = new Show();
            $show->setTitle($showData["title"]);
            $show->setDescription($showData["description"]);
            $show->setDatePublication(new \DateTime());
            $show->setReleaseDate(new \DateTime($showData["releaseDate"]));
            $show->setCategorieShowId($categoriesShow[$showData["categoryIndex"]]);
            $manager->persist($show);
            $shows[] = $show;
        }


        $showVideosData = [
            ["showIndex" => 0, "description" => "Bande-annonce officielle d'Inception", "image" => "inception.jpg", "url" => "https://video.example.com/inception", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "4K HDR", "viewingTime" => "02:28:00"],
            ["showIndex" => 1, "description" => "Bande-annonce officielle de Léon", "image" => "leon.jpg", "url" => "https://video.example.com/leon", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "Full HD", "viewingTime" => "01:50:00"],
            ["showIndex" => 2, "description" => "Bande-annonce officielle d'Alien", "image" => "alien.jpg", "url" => "https://video.example.com/alien", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "HD", "viewingTime" => "01:57:00"],
        ];

        foreach ($showVideosData as $showVideoData) {
            $showVideo = new ShowVideo();
            $showVideo->setDescriptionVideo($showVideoData["description"]);
            $showVideo->setImageVideo($showVideoData["image"]);
            $showVideo->setUrlVideo($showVideoData["url"]);
            $showVideo->setEpisodeNumber($showVideoData["episodeNumber"]);
            $showVideo->setSaisonNumber($showVideoData["saisonNumber"]);
            $showVideo->setVideoQuality($showVideoData["videoQuality"]);
            $showVideo->setViewingTime(new \DateTime($showVideoData["viewingTime"]));
            $showVideo->setShowId($shows[$showVideoData["showIndex"]]);
            $manager->persist($showVideo);

        }
        
        $manager->flush();
    }
}
