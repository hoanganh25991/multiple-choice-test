<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/23/2015
 * Time: 4:40 PM
 */
namespace {
    /**
     * Created by PhpStorm.
     *
     * User: Hoang Anh
     * Date: 12/23/2015
     * Time: 4:40 PM
     *
     * @property integer $id
     * @property string $keystone
     * @property string $email
     * @property string $remember_token
     * @property \Carbon\Carbon $created_at
     * @property \Carbon\Carbon $updated_at
     * @property string $result
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereKeystone($value)
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereEmail($value)
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereRememberToken($value)
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\Contestant whereResult($value)
     */
    use Illuminate\Auth\UserInterface;
    use Illuminate\Auth\UserTrait;
    use Illuminate\Auth\Reminders\RemindableTrait;

    class Contestant extends Eloquent implements UserInterface {
        use UserTrait, RemindableTrait;
        protected $hidden = array('keystone', 'remember_token');
        protected $table = 'contestants';

        /**
         * Get the unique identifier for the user.
         *
         * @return mixed
         */
        public function getAuthIdentifier() {
            return $this->getKey();
        }

        /**
         * Get the password for the user.
         *
         * @return string
         */
        public function getAuthPassword() {
            return $this->key_stone;
        }

        /**
         * Get the token value for the "remember me" session.
         *
         * @return string
         */
        public function getRememberToken() {
            return $this->remember_token;
        }

        /**
         * Set the token value for the "remember me" session.
         *
         * @param  string $value
         * @return void
         */
        public function setRememberToken($value) {
            $this->remember_token = $value;
        }

        /**
         * Get the column name for the "remember me" token.
         *
         * @return string
         */
        public function getRememberTokenName() {
            return 'remember_token';
        }
    }
}