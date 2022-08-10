# Ayarlanabilir Randevu Takvimi

Bu projede veri tabanı üzerinden düzenlenebilir bir randevu takvimi geliştirdim. Bu randevu takvimi sayesinde bir site üzerinden istenilen gün ve saatte randevu alınabilmektedir. Yapılan randevular bir veri tabanında tutulmakta ve yapıldığı gün ve saatte dolu olarak işaretlenmektedir. Site sahibi randevuların başlangıç ​​ve bitiş saatlerini, randevuyu kapatmak istediği gün ve tarihleri belirleyebilir.

**Not:** Site sahibinin istediği günler ile tarihleri admin panelinden ayarlaması gerektiği için burada ilgili kodlara yer verilmemektedir. 

## Kullanım

Projeyi çalışır hale getirmek için öncelikle `mysql` üzerinde bir veri tabanı oluşturun. Oluşturduğunuz veri tabanına `db_tables.php` klasöründe bulunan `randevular.sql` ve `dolu_randevular.sql` SQL tablolarını **içe aktar** sekmesine tıklayarak tabloları tek tek içe aktarın. Daha sonra `db_connect.php` dosyasında bulunan veri tabanı bağlantı kodlarını kendi veri tabanı bilgileriniz göre düzenleyin.

## Ekran Çıktısı
![Project](https://github.com/yasinakbulut25/Ayarlanabilir-Randevu-Takvimi/blob/main/screenshots/gif.gif?raw=true)
