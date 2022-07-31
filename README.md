# laravel-ads

## Step One Clone Repo

    git clone git@github.com:coder0010/grand

or you can download it by the desktop application of github

    https://github.com/coder0010/grand

Switch to the repo folder

    cd grand

---
## Step Two Prepare Project

1 Prepare the project

    make build-up || docker-compose up -d --build

2 Copy .env.example file and make the required configuration changes in the .env file

    cp .env.example ./.env

3 Run this command

    php artisan server:setup
        * choose Create_Database
        * Then choose Migrate_and_Seed

4- Run Schedule and test reminder

    * php artisan schedule:work

#### Notes 

* make sure that tables are exists [ jobs, failed_jobs, notifications ]
* for using laravel-ads package at new laravel project make sure to add this relation to user.php model
    /**
     * ads Relationship.
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
* add seeders 
        Ad::factory(2)->freeType()->create();
        Ad::factory(2)->paidType()->create();