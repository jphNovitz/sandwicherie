/* Allergies List
*  Receive allergies as an array of objects
*  return (array) a list of ingredients and categories to avoid
*  part of laclementine.be project (2018)  */


export default function allergies_list (allergies){
    let list = {};
    allergies.map(al=>{
        list[al.slug]=[]
        al.categories.map(categ=>{
            list[al.slug].push(categ.slug)
        })
        al.ingredients.map(ingr=>{
            list[al.slug].push(ingr.slug)
        })
    })
    return list;
}