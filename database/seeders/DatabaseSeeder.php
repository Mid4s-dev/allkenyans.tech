<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlockedAccount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'google_id' => null,
        ]);

        // Create regular users
        User::factory(5)->create();

        // Create blocked accounts
        $users = User::all();
        $categories = ['porn', 'hate_speech', 'propaganda', 'scam', 'other'];
        
        // Sample Twitter accounts to block
        $twitterAccounts = [
            ['id' => '123456', 'username' => 'spammer1'],
            ['id' => '234567', 'username' => 'hatespeech1'],
            ['id' => '345678', 'username' => 'propaganda1'],
            ['id' => '456789', 'username' => 'scammer1'],
            ['id' => '567890', 'username' => 'adult1'],
            ['id' => '678901', 'username' => 'spammer2'],
            ['id' => '789012', 'username' => 'hatespeech2'],
            ['id' => '890123', 'username' => 'propaganda2'],
            ['id' => '901234', 'username' => 'scammer2'],
            ['id' => '012345', 'username' => 'adult2'],
        ];

        // Create multiple blocks for each account to generate meaningful statistics
        foreach ($twitterAccounts as $account) {
            // Each account will be blocked by different users (but only once per user)
            $selectedUsers = $users->random(min(count($users), rand(5, 15)));
            foreach ($selectedUsers as $user) {
                BlockedAccount::create([
                    'user_id' => $user->id,
                    'twitter_account_id' => $account['id'],
                    'username' => $account['username'],
                    'category' => $categories[array_rand($categories)],
                    'reason' => fake()->sentence(),
                ]);
            }
        }

        // Create some additional random blocks with unique user-twitter_account combinations
        foreach (range(1, 50) as $index) {
            $user = $users->random();
            $uniqueTwitterId = fake()->unique()->numerify('#######');
            BlockedAccount::create([
                'user_id' => $user->id,
                'twitter_account_id' => $uniqueTwitterId,
                'username' => 'random_user_' . $uniqueTwitterId,
                'category' => $categories[array_rand($categories)],
                'reason' => fake()->sentence(),
            ]);
        }
    }
}
