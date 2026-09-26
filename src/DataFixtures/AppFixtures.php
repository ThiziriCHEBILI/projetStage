<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Show;
use App\Entity\CategoriesShow;
use App\Entity\ShowVideo;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categoriesShowData = [
            ["name" => "films"],
            ["name" => "series"],
            ["name" => "dessins-animes"],

        ];

        $categoriesShow = [];
        foreach ($categoriesShowData as $categoryData) {
            $category = new CategoriesShow();
            $category->setName($categoryData["name"]);
            $manager->persist($category);
            $categoriesShow[] = $category;
        }


        $showsData = [
            // Films (categoryIndex => 0)
            ["title" => "Dune: Deuxième Partie", "description" => "Paul Atréides s'unit aux Fremen pour se venger des conspirateurs qui ont détruit sa famille.", "categoryIndex" => 0, "releaseDate" => "2024-02-28"],
            ["title" => "Oppenheimer", "description" => "L'histoire du physicien J. Robert Oppenheimer et de son rôle dans le développement de la bombe atomique.", "categoryIndex" => 0, "releaseDate" => "2023-07-19"],
            
            // Séries (categoryIndex => 1)
            ["title" => "The Last of Us", "description" => "Un contrebandier est chargé d'escorter une adolescente à travers une Amérique post-apocalyptique.", "categoryIndex" => 1, "releaseDate" => "2023-01-15"],
            ["title" => "Squid Game", "description" => "Des centaines de joueurs endettés s'affrontent dans des jeux d'enfants mortels pour un énorme prix en argent.", "categoryIndex" => 1, "releaseDate" => "2021-09-17"],
           

            // Dessins animés (categoryIndex => 2)
            ["title" => "Le Garçon et le Héron", "description" => "Un jeune garçon en deuil part à la recherche de sa mère disparue dans un monde fantastique.", "categoryIndex" => 2, "releaseDate" => "2023-07-14"],
            ["title" => "Vaïana 2", "description" => "Vaïana part pour un nouveau voyage à travers les mers du Pacifique après avoir reçu un appel inattendu de ses ancêtres.", "categoryIndex" => 2, "releaseDate" => "2024-11-27"],
            
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
            // Films
            ["showIndex" => 0, "description" => "Bande-annonce officielle de Dune: Deuxième Partie", "image" => "dune2.jpg", "url" => "https://video.example.com/dune2", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "4K HDR", "viewingTime" => "02:46:00"],
            ["showIndex" => 1, "description" => "Bande-annonce officielle d'Oppenheimer", "image" => "oppenheimer.jpg", "url" => "https://video.example.com/oppenheimer", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "Full HD", "viewingTime" => "03:00:00"],

            // Séries
            ["showIndex" => 2, "description" => "The Last of Us - Saison 1, Épisode 3", "image" => "lastofus.jpg", "url" => "https://video.example.com/lastofus-s1e3", "episodeNumber" => 3, "saisonNumber" => 1, "videoQuality" => "4K HDR", "viewingTime" => "01:16:00"],
            ["showIndex" => 3, "description" => "Squid Game - Saison 2, Épisode 5", "image" => "squidgame.jpg", "url" => "https://video.example.com/squidgame-s2e5", "episodeNumber" => 5, "saisonNumber" => 2, "videoQuality" => "Full HD", "viewingTime" => "00:55:00"],

            // Dessins animés
            ["showIndex" => 4, "description" => "Bande-annonce officielle du Garçon et le Héron", "image" => "garconheron.jpg", "url" => "https://video.example.com/garconheron", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "Full HD", "viewingTime" => "02:04:00"],
            ["showIndex" => 5, "description" => "Bande-annonce officielle de Vaïana 2", "image" => "vaiana2.jpg", "url" => "https://video.example.com/vaiana2", "episodeNumber" => 1, "saisonNumber" => 1, "videoQuality" => "4K HDR", "viewingTime" => "01:40:00"],
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
