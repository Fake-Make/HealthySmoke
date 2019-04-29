SELECT count(*) FROM goods WHERE id IN 
	(SELECT goodID FROM goodToCategories WHERE
		categoryID = $catId);

SELECT count(*) FROM goods
INNER JOIN goodToCategories
ON goods.id = goodToCategories.goodID
WHERE categoryID = $catId;