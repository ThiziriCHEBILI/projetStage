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
            ["title" => "Dune: Deuxième Partie", "description" => "Paul Atréides s'unit aux Fremen pour se venger des conspirateurs qui ont détruit sa famille.", "categoryIndex" => 0, "datePublication" => "2026-09-28", "releaseDate" => "2024-02-28", "type_show" => "sci-fi", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner",  "quality" => "4K HDR"],
            ["title" => "Oppenheimer", "description" => "L'histoire du physicien J. Robert Oppenheimer et de son rôle dans le développement de la bombe atomique.", "categoryIndex" => 0, "datePublication" => "2026-05-14", "releaseDate" => "2023-07-19", "type_show" => "drame", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Interstellar", "description" => "Des explorateurs traversent un trou de ver pour trouver une nouvelle terre habitable.", "categoryIndex" => 0, "datePublication" => "2026-04-02", "releaseDate" => "2014-11-05", "type_show" => "sci-fi", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "4K HDR"],
            ["title" => "Inception", "description" => "Un voleur s'infiltre dans les rêves pour y dérober des secrets.", "categoryIndex" => 0, "datePublication" => "2026-04-18", "releaseDate" => "2010-07-21", "type_show" => "sci-fi", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Seven", "description" => "Deux inspecteurs traquent un tueur qui met en scène les sept péchés capitaux.", "categoryIndex" => 0, "datePublication" => "2026-06-09", "releaseDate" => "1995-09-22", "type_show" => "thriller", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Mad Max: Fury Road", "description" => "Dans un désert post-apocalyptique, une guerrière fuit un tyran avec quelques survivantes.", "categoryIndex" => 0, "datePublication" => "2026-08-21", "releaseDate" => "2015-05-14", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner",  "quality" => "4K HDR"],
            ["title" => "Indiana Jones", "description" => "Un archéologue part à la recherche d'une relique avant que ses ennemis ne la trouvent.", "categoryIndex" => 0, "datePublication" => "2026-05-30", "releaseDate" => "1981-06-12", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Conjuring", "description" => "Deux enquêteurs du paranormal viennent en aide à une famille terrorisée dans sa ferme.", "categoryIndex" => 0, "datePublication" => "2026-07-12", "releaseDate" => "2013-07-19", "type_show" => "horreur", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Le Parrain", "description" => "Le chef vieillissant d'une famille mafieuse transmet son empire à son fils cadet.", "categoryIndex" => 0, "datePublication" => "2026-03-15", "releaseDate" => "1972-03-24", "type_show" => "drame", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner",  "quality" => "4K HDR"],
            ["title" => "John Wick", "description" => "Un ancien tueur à gages sort de sa retraite pour venger la mort de son chien.", "categoryIndex" => 0, "datePublication" => "2026-10-05", "releaseDate" => "2014-10-24", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "4K HDR"],

            // Séries (categoryIndex => 1)
            ["title" => "The Last of Us", "description" => "Un contrebandier est chargé d'escorter une adolescente à travers une Amérique post-apocalyptique.", "categoryIndex" => 1, "datePublication" => "2026-10-01", "releaseDate" => "2023-01-15", "type_show" => "drame", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner", "season_count" => 1, "quality" => "4K HDR"],
            ["title" => "Squid Game", "description" => "Des centaines de joueurs endettés s'affrontent dans des jeux d'enfants mortels pour un énorme prix en argent.", "categoryIndex" => 1, "datePublication" => "2026-09-12", "releaseDate" => "2021-09-17", "type_show" => "thriller", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 2, "quality" => "Full HD"],
            ["title" => "Stranger Things", "description" => "Dans une petite ville de l'Indiana, la disparition d'un enfant révèle un monde parallèle.", "categoryIndex" => 1, "datePublication" => "2026-06-25", "releaseDate" => "2016-07-15", "type_show" => "horreur", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "La Casa de Papel", "description" => "Un génie du crime orchestre le plus grand braquage de l'histoire de l'Espagne.", "categoryIndex" => 1, "datePublication" => "2026-05-08", "releaseDate" => "2017-05-02", "type_show" => "thriller", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 5, "quality" => "Full HD"],
            ["title" => "Lupin", "description" => "Inspiré par Arsène Lupin, Assane Diop venge son père victime d'une injustice.", "categoryIndex" => 1, "datePublication" => "2026-07-30", "releaseDate" => "2021-01-08", "type_show" => "thriller", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 3, "quality" => "4K HDR"],
            ["title" => "Dark", "description" => "La disparition d'enfants dans une petite ville allemande révèle un secret de famille.", "categoryIndex" => 1, "datePublication" => "2026-04-26", "releaseDate" => "2017-12-01", "type_show" => "sci-fi", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 3, "quality" => "4K HDR"],
            ["title" => "Breaking Bad", "description" => "Un professeur de chimie se lance dans la fabrication de drogue pour assurer l'avenir des siens.", "categoryIndex" => 1, "datePublication" => "2026-03-22", "releaseDate" => "2008-01-20", "type_show" => "drame", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner", "season_count" => 5, "quality" => "Full HD"],
            ["title" => "The Witcher", "description" => "Un chasseur de monstres solitaire croise la route d'une princesse en fuite.", "categoryIndex" => 1, "datePublication" => "2026-08-14", "releaseDate" => "2019-12-20", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 3, "quality" => "4K HDR"],
            ["title" => "Black Mirror", "description" => "Chaque épisode imagine une dérive possible de notre rapport à la technologie.", "categoryIndex" => 1, "datePublication" => "2026-09-19", "releaseDate" => "2011-12-04", "type_show" => "sci-fi", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 6, "quality" => "4K HDR"],
            ["title" => "Peaky Blinders", "description" => "Une famille de gangsters étend son pouvoir dans l'Angleterre d'après-guerre.", "categoryIndex" => 1, "datePublication" => "2026-06-11", "releaseDate" => "2013-09-12", "type_show" => "drame", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 6, "quality" => "Full HD"],

            // Dessins animés (categoryIndex => 2)
            ["title" => "Le Garçon et le Héron", "description" => "Un jeune garçon en deuil part à la recherche de sa mère disparue dans un monde fantastique.", "categoryIndex" => 2, "datePublication" => "2026-10-08", "releaseDate" => "2023-07-14", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner",  "quality" => "Full HD"],
            ["title" => "Vaïana 2", "description" => "Vaïana part pour un nouveau voyage à travers les mers du Pacifique après avoir reçu un appel inattendu de ses ancêtres.", "categoryIndex" => 2, "datePublication" => "2026-09-05", "releaseDate" => "2024-11-27", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "4K HDR"],
            ["title" => "Arcane", "description" => "Deux sœurs se retrouvent dans des camps opposés d'une guerre entre deux cités.", "categoryIndex" => 2, "datePublication" => "2026-07-18", "releaseDate" => "2021-11-06", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 2, "quality" => "4K HDR"],
            ["title" => "Le Voyage de Chihiro", "description" => "Une fillette se retrouve piégée dans un monde d'esprits et doit travailler pour sauver ses parents.", "categoryIndex" => 2, "datePublication" => "2026-04-10", "releaseDate" => "2001-07-20", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner",  "quality" => "Full HD"],
            ["title" => "Princesse Mononoké", "description" => "Un jeune prince se retrouve au milieu du conflit entre les dieux de la forêt et les humains.", "categoryIndex" => 2, "datePublication" => "2026-03-28", "releaseDate" => "1997-07-12", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Mon Voisin Totoro", "description" => "Deux sœurs installées à la campagne rencontrent un esprit gardien de la forêt.", "categoryIndex" => 2, "datePublication" => "2026-05-22", "releaseDate" => "1988-04-16", "type_show" => "aventure", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "Full HD"],
            ["title" => "Demon Slayer", "description" => "Un jeune garçon devient pourfendeur de démons pour sauver sa sœur transformée.", "categoryIndex" => 2, "datePublication" => "2026-08-07", "releaseDate" => "2019-04-06", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "L'Attaque des Titans", "description" => "Des humains réfugiés derrière d'immenses murs luttent contre des géants dévoreurs d'hommes.", "categoryIndex" => 2, "datePublication" => "2026-06-18", "releaseDate" => "2013-04-07", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "award" => "award winner", "season_count" => 4, "quality" => "4K HDR"],
            ["title" => "Jujutsu Kaisen", "description" => "Un lycéen avale une relique maudite et rejoint une école d'exorcistes.", "categoryIndex" => 2, "datePublication" => "2026-07-03", "releaseDate" => "2020-10-03", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png", "season_count" => 2, "quality" => "4K HDR"],
            ["title" => "Spider-Man: New Generation", "description" => "Un adolescent devient Spider-Man et rencontre ses homologues venus d'autres dimensions.", "categoryIndex" => 2, "datePublication" => "2026-10-10", "releaseDate" => "2018-12-12", "type_show" => "action", "image_show" => "/imageVideo.png", "image_poster" => "/imagePoster.png",  "quality" => "4K HDR"],
        ];


        $shows = [];
        foreach ($showsData as $showData) {
            $show = new Show();
            $show->setTitle($showData["title"]);
            $show->setDescription($showData["description"]);
            $show->setDatePublication(new \DateTime($showData["datePublication"]));
            $show->setReleaseDate(new \DateTime($showData["releaseDate"]));
            $show->setAward($showData["award"] ?? null);
            $show->setTypeShow($showData["type_show"] ?? null);
            $show->setImageShow($showData["image_show"]);
            $show->setImagePoster($showData["image_poster"]);
            $show->setSeasonCount($showData["season_count"] ?? null);
            $show->setQuality($showData["quality"]);
            $show->setCategoryShow($categoriesShow[$showData["categoryIndex"]]);
            $manager->persist($show);
            $shows[] = $show;
        }

        $showVideosData = [
            // Films
            ["showIndex" => 0, "description" => "Bande-annonce officielle de Dune: Deuxième Partie", "image" => "dune2.jpg", "url" => "https://video.example.com/dune2", "videoQuality" => "4K HDR", "duration" => "02:46:00"],
            ["showIndex" => 1, "description" => "Bande-annonce officielle d'Oppenheimer", "image" => "oppenheimer.jpg", "url" => "https://video.example.com/oppenheimer", "videoQuality" => "Full HD", "duration" => "03:00:00"],
            ["showIndex" => 2, "description" => "Bande-annonce officielle d'Interstellar", "image" => "interstellar.jpg", "url" => "https://video.example.com/interstellar", "videoQuality" => "4K HDR", "duration" => "02:49:00"],
            ["showIndex" => 3, "description" => "Bande-annonce officielle d'Inception", "image" => "inception.jpg", "url" => "https://video.example.com/inception", "videoQuality" => "Full HD", "duration" => "02:28:00"],
            ["showIndex" => 4, "description" => "Bande-annonce officielle de Seven", "image" => "seven.jpg", "url" => "https://video.example.com/seven", "videoQuality" => "Full HD", "duration" => "02:07:00"],
            ["showIndex" => 5, "description" => "Bande-annonce officielle de Mad Max: Fury Road", "image" => "madmax.jpg", "url" => "https://video.example.com/madmax", "videoQuality" => "4K HDR", "duration" => "02:00:00"],
            ["showIndex" => 6, "description" => "Bande-annonce officielle d'Indiana Jones", "image" => "indianajones.jpg", "url" => "https://video.example.com/indianajones", "videoQuality" => "Full HD", "duration" => "01:55:00"],
            ["showIndex" => 7, "description" => "Bande-annonce officielle de Conjuring", "image" => "conjuring.jpg", "url" => "https://video.example.com/conjuring", "videoQuality" => "Full HD", "duration" => "01:52:00"],
            ["showIndex" => 8, "description" => "Bande-annonce officielle du Parrain", "image" => "leparrain.jpg", "url" => "https://video.example.com/leparrain", "videoQuality" => "4K HDR", "duration" => "02:55:00"],
            ["showIndex" => 9, "description" => "Bande-annonce officielle de John Wick", "image" => "johnwick.jpg", "url" => "https://video.example.com/johnwick", "videoQuality" => "4K HDR", "duration" => "01:41:00"],

            // Séries
            ["showIndex" => 10, "description" => "The Last of Us - Saison 1, Épisode 3", "image" => "lastofus.jpg", "url" => "https://video.example.com/lastofus-s1e3", "episodeNumber" => 3, "saisonNumber" => 1, "videoQuality" => "4K HDR", "duration" => "01:16:00"],
            ["showIndex" => 11, "description" => "Squid Game - Saison 2, Épisode 5", "image" => "squidgame.jpg", "url" => "https://video.example.com/squidgame-s2e5", "episodeNumber" => 5, "saisonNumber" => 2, "videoQuality" => "Full HD", "duration" => "00:55:00"],
            ["showIndex" => 12, "description" => "Stranger Things - Saison 4, Épisode 1", "image" => "strangerthings.jpg", "url" => "https://video.example.com/strangerthings-s4e1", "episodeNumber" => 1, "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:50:00"],
            ["showIndex" => 13, "description" => "La Casa de Papel - Saison 5, Épisode 1", "image" => "casadepapel.jpg", "url" => "https://video.example.com/casadepapel-s5e1", "episodeNumber" => 1, "saisonNumber" => 5, "videoQuality" => "Full HD", "duration" => "00:45:00"],
            ["showIndex" => 14, "description" => "Lupin - Saison 3, Épisode 1", "image" => "lupin.jpg", "url" => "https://video.example.com/lupin-s3e1", "episodeNumber" => 1, "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:45:00"],
            ["showIndex" => 15, "description" => "Dark - Saison 3, Épisode 1", "image" => "dark.jpg", "url" => "https://video.example.com/dark-s3e1", "episodeNumber" => 1, "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "00:55:00"],
            ["showIndex" => 16, "description" => "Breaking Bad - Saison 5, Épisode 1", "image" => "breakingbad.jpg", "url" => "https://video.example.com/breakingbad-s5e1", "episodeNumber" => 1, "saisonNumber" => 5, "videoQuality" => "Full HD", "duration" => "00:47:00"],
            ["showIndex" => 17, "description" => "The Witcher - Saison 3, Épisode 1", "image" => "thewitcher.jpg", "url" => "https://video.example.com/thewitcher-s3e1", "episodeNumber" => 1, "saisonNumber" => 3, "videoQuality" => "4K HDR", "duration" => "01:00:00"],
            ["showIndex" => 18, "description" => "Black Mirror - Saison 6, Épisode 1", "image" => "blackmirror.jpg", "url" => "https://video.example.com/blackmirror-s6e1", "episodeNumber" => 1, "saisonNumber" => 6, "videoQuality" => "4K HDR", "duration" => "01:00:00"],
            ["showIndex" => 19, "description" => "Peaky Blinders - Saison 6, Épisode 1", "image" => "peakyblinders.jpg", "url" => "https://video.example.com/peakyblinders-s6e1", "episodeNumber" => 1, "saisonNumber" => 6, "videoQuality" => "Full HD", "duration" => "00:58:00"],

            // Dessins animés
            ["showIndex" => 20, "description" => "Bande-annonce officielle du Garçon et le Héron", "image" => "garconheron.jpg", "url" => "https://video.example.com/garconheron", "videoQuality" => "Full HD", "duration" => "02:04:00"],
            ["showIndex" => 21, "description" => "Bande-annonce officielle de Vaïana 2", "image" => "vaiana2.jpg", "url" => "https://video.example.com/vaiana2", "videoQuality" => "4K HDR", "duration" => "01:40:00"],
            ["showIndex" => 22, "description" => "Arcane - Saison 2, Épisode 1", "image" => "arcane.jpg", "url" => "https://video.example.com/arcane-s2e1", "episodeNumber" => 1, "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:40:00"],
            ["showIndex" => 23, "description" => "Bande-annonce officielle du Voyage de Chihiro", "image" => "chihiro.jpg", "url" => "https://video.example.com/chihiro", "videoQuality" => "Full HD", "duration" => "02:05:00"],
            ["showIndex" => 24, "description" => "Bande-annonce officielle de Princesse Mononoké", "image" => "mononoke.jpg", "url" => "https://video.example.com/mononoke", "videoQuality" => "Full HD", "duration" => "02:14:00"],
            ["showIndex" => 25, "description" => "Bande-annonce officielle de Mon Voisin Totoro", "image" => "totoro.jpg", "url" => "https://video.example.com/totoro", "videoQuality" => "Full HD", "duration" => "01:26:00"],
            ["showIndex" => 26, "description" => "Demon Slayer - Saison 4, Épisode 1", "image" => "demonslayer.jpg", "url" => "https://video.example.com/demonslayer-s4e1", "episodeNumber" => 1, "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:24:00"],
            ["showIndex" => 27, "description" => "L'Attaque des Titans - Saison 4, Épisode 1", "image" => "attaquetitans.jpg", "url" => "https://video.example.com/attaquetitans-s4e1", "episodeNumber" => 1, "saisonNumber" => 4, "videoQuality" => "4K HDR", "duration" => "00:24:00"],
            ["showIndex" => 28, "description" => "Jujutsu Kaisen - Saison 2, Épisode 1", "image" => "jujutsukaisen.jpg", "url" => "https://video.example.com/jujutsukaisen-s2e1", "episodeNumber" => 1, "saisonNumber" => 2, "videoQuality" => "4K HDR", "duration" => "00:24:00"],
            ["showIndex" => 29, "description" => "Bande-annonce officielle de Spider-Man: New Generation", "image" => "spiderman.jpg", "url" => "https://video.example.com/spiderman", "videoQuality" => "4K HDR", "duration" => "01:57:00"],
        ];

        foreach ($showVideosData as $showVideoData) {
            $showVideo = new ShowVideo();
            $showVideo->setDescriptionVideo($showVideoData["description"]);
            $showVideo->setImageVideo($showVideoData["image"]);
            $showVideo->setUrlVideo($showVideoData["url"]);
            $showVideo->setEpisodeNumber($showVideoData["episodeNumber"] ?? null);
            $showVideo->setSaisonNumber($showVideoData["saisonNumber"] ?? null);
            $showVideo->setVideoQuality($showVideoData["videoQuality"]);
            $showVideo->setDuration(new \DateTime($showVideoData["duration"]));
            $showVideo->setShowId($shows[$showVideoData["showIndex"]]);
            $manager->persist($showVideo);
        }

        $manager->flush();
    }
}
