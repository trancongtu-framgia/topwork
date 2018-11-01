<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            //tao company
            $role = new \App\Models\Role();
            $role->name = 'company';
            $role->save();

            $user = new \App\User();
            $user->email = 'vu.duy.luat@framgia.com';
            $user->name = 'Framgia';
            $user->password = Hash::make('123456789');
            $user->user_name = 'vu.duy.luat@framgia.com';
            $user->status = 1;
            $user->role_id = $role->id;
            $user->token = Uuid::generate()->string;
            $user->save();

            $company = new \App\Models\Company();
            $company->user_id = $user->id;
            $company->address = '13F Keangnam Landmark 72 Tower, Plot E6, Pham Hung Road, Nam Tu Liem District., Ha Noi';
            $company->country = 'Japan';
            $company->working_day = 'Thu 2 - Thu 6';
            $company->description = '<h3>One of the leading technical IT group in Asia</h3>
                                    <p>&nbsp;</p>
                                    <p><strong>Framgia Việt Nam</strong>&nbsp;là; công ty IT Nhật Bản được thành lập vào tháng 10/2012, hoạt động trong các lĩnh vực:</p>
                                    <ul>
                                        <li><strong>Software development:</strong></li>
                                    </ul>
                                    <p>- Offshore: Cung cấp dịch vụ tư vấn, thiết kế, phát triển phần mềm cho khách hàng Nhật Bản.&nbsp;<br />
                                    - In-house product: Sản xuất và phát triển các sản phẩm công nghệ trực tuyến: Viblo, Awesome; nghiên cứu và; phát triển các sản phẩm công nghệ mới sử dụng công nghệ AI, Blockchain, VR&AR.&nbsp;</p>
                                    <ul>
                                        <li><strong>Business development:</strong>&nbsp;Tìmm kiếm, đầu tư và hợp tác với các start-up công nghệ tiềm năng.</li>
                                        <li><strong>Human resource development:</strong>&nbsp;Hợp tác với các trường đại học tổ chức các chương trình đào tạo Tiếng Nhật IT, xây dựng trung tâm đào tạo và lập trình Framgia Academy.</li>
                                    </ul>
                                    <p>Với mục tiêu trở thành " Tập đoàn IT hàng đầu châu Á", chúng tôi luôn tìm kiếm và đón chào các kỹ sư tài năng luôn cố gắng vươn đến những tầm cao mới, không ngại thay đổi và luôn luôn sẵn sàng đương đầu với thử thách.</p>';
            $company->logo_url = 'framgia.png';
            $company->range = '1000++';
            $company->save();

            $user = new \App\User();
            $user->email = 'luatvd95@gmail.com';
            $user->name = 'ButChi';
            $user->password = Hash::make('123456789');
            $user->user_name = 'luatvd95@gmail.com';
            $user->status = 1;
            $user->role_id = $role->id;
            $user->token = Uuid::generate()->string;
            $user->save();

            $company = new \App\Models\Company();
            $company->user_id = $user->id;
            $company->address = 'Hung Yen';
            $company->country = 'Viet Nam';
            $company->working_day = 'Thu 2 - Thu 6';
            $company->description = '<h3>LG Electronics is made up of five forward-looking business units</h3>
                                    <p>Home Entertainment, Mobile Communications, Home Appliance, Air Conditioning, Energy Solution &amp; Vehicle Components<br />
                                    With the advent of the Smart Car era, LG hopes to become an innovative partner in vehicle electrification through development of advanced technology components. Vehicle Component Company (VC) is developing a wide variety of highly competitive products. Our products include In Vehicle Infotainment system such as Telematics, AV Navigation, Display Audio, Integrated Display System &amp; Advanced Driver Assistant System (ADAS) called &lsquo;intelligent safe&rsquo;, &amp; other convenient devices. Our company is also focusing on vehicle engineering, to include Powertrain, electronic vehicle Battery Packs, etc &amp; is providing them to major customers in the world-wide vehicle industry<br />
                                    We offer an environment that enables colleagues to demonstrate their capabilities, focus on their work and create value</p>';
            $company->logo_url = 'jg.png';
            $company->range = '200 - 1000';
            $company->save();
            //tao candidate
            $role = new \App\Models\Role();
            $role->name = 'candidate';
            $role->save();

            $user = new \App\User();
            $user->email = 'nhoccon05061995@gmail.com';
            $user->name = 'Vu Duy Luat';
            $user->password = Hash::make('123456789');
            $user->user_name = 'nhoccon05061995@gmail.com';
            $user->status = 1;
            $user->role_id = $role->id;
            $user->token = Uuid::generate()->string;
            $user->save();

            $candidate = new \App\Models\Candidate();
            $candidate ->dob = '1995-05-06';
            $candidate ->address = 'Cuong Chinh - Tien Lu - Hung Yen';
            $candidate ->phone = '0369 199 605';
            $candidate ->description = '<p>Hòa đồng, thân thiện, dễ hòa nhập </p> <p> Chăm chỉ học hỏi</p>';
            $candidate ->user_id = $user->id;
            $candidate ->experience = '1 years';
            $candidate->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $e;
        }
    }
}
