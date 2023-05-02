DELETE a, b
FROM wp_posts AS a
JOIN wp_postmeta AS b
JOIN wp_postmeta AS c
WHERE b.post_id = a.ID AND c.post_id = a.ID
AND a.post_type = 'shop_coupon'
AND b.meta_key = 'discount_type' AND b.meta_value = 'fixed_cart'
AND c.meta_key = 'expiry_date' AND c.meta_value = '2022-12-31'

/* 
    Bu kodu phpmyadmin veya başka bir SQL yönetim alanında çalıştırdığınızda toplu şekilde kuponları 
    veritabanından silmiş olacaksınız.
*/    

/* 

    Özellikle discount_type önemli bir durum burada. 
    Bazı değerleri mevcut onları aşağıda listeliyorum. 
    Bunun yanı sıra bu örnekte expiry_date yani son kullanım tarihi şu olanları işaretle şeklinde filtrelemişiz.
    Bu şartlara uyum sağlayan tüm kupon kodlarını tek kalemde silecektir.

*/

/*

    Kullanılabilir discount_type'lar.

    fixed_cart: Sepetteki sabit indirim tutarı
    cart_coupon: Kullanılan kupon kodu
    product_discount: Ürünlerin indirim tutarı
    free_shipping: Ücretsiz kargo seçeneği etkinleştirildiğinde

*/
