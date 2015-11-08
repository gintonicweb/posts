<?php
namespace Posts\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Posts\Model\Entity\Post;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Phinxlog
 */
class PostsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Phinxlog', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'phinxlog_id',
            'joinTable' => 'posts_phinxlog',
            'className' => 'Posts.Phinxlog'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->requirePresence('intro', 'create')
            ->notEmpty('intro');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
