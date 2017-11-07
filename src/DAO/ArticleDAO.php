<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 03/11/2017
 * Time: 20:21
 */

namespace Todo\DAO;

use Todo\Domain\Article;
use Todo\Domain\User;

class ArticleDAO extends DAO
{
    /**
     * @var UserDAO
     */
    private $userDao;

    /**
     * @param UserDAO $userDao
     */
    public function setUserDao(UserDAO $userDao)
    {
        $this->userDao = $userDao;
    }

    public function findByUser (User $user)
    {
        $sql = 'SELECT * FROM t_articles WHERE t_articles.usr_id=?';
        $rows = $this->getDb()->fetchAll($sql, [$user->getId()]);

        $articles = [];
        foreach ($rows as $row) {
            $articles[] = $this->buildDomainObject($row);
        }

        return $articles;
    }

    public function find ($id)
    {
        $sql = 'SELECT * FROM t_articles WHERE art_id=?';
        $row = $this->getDb()->fetchAssoc($sql, [$id]);

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception(sprintf('No article matching id %s', $id));
        }
    }

    /**
     * @return array
     */
    public function findAll ()
    {
        $sql = 'SELECT * FROM t_articles ORDER BY art_date';
        $rows = $this->getDb()->fetchAll($sql);

        $articles = [];

        foreach ($rows as $row) {
            $articles[] = $this->buildDomainObject($row);
        }

        return $articles;
    }

    protected function buildDomainObject(array $row)
    {
        $article = new Article();
        $article
            ->setId($row['art_id'])
            ->setContent($row['art_content'])
            ->setTitle($row['art_title'])
            ->setDate($row['art_date'])
            ->setUser($this->userDao->find($row['usr_id']));

        return $article;
    }

    /**
     * @param Article
     */
    public function save (Article $article)
    {

        $row = [
            'art_id' => $article->getId(),
            'art_title' => $article->getTitle(),
            'art_content' => $article->getContent(),
            'art_date' => $article->getDate(),
            'usr_id' => $article->getUser()->getId(),
        ];

        if ($article->getId()) {
            $this->getDb()->update('t_articles', $row, [
                'art_id' => $article->getId(),
            ]);
        } else {
            $this->getDb()->insert('t_articles', $row);
            $article->setId($this->getDb()->lastInsertId());
        }
    }
}